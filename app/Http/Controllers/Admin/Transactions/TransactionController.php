<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\DTO\Transactions\Criteria\FinancialRecordCriteriaDTO;
use App\DTO\Transactions\TransactionDTO;
use App\DTO\Transactions\TransactionPaymentDTO;
use App\Excel\Exports\FinanceExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transactions\TransactionExcelExportRequest;
use App\Http\Requests\Admin\Transactions\TransactionStoreRequest;
use App\Http\Requests\Admin\Transactions\TransactionUpdateRequest;
use App\Http\Resources\Transactions\TransactionResource;
use App\Services\Merchants\MerchantPaymentSystemServiceInterface;
use App\Services\Merchants\MerchantServiceInterface;
use App\Services\Transactions\Financials\FinancialRecordServiceInterface;
use App\Services\Transactions\Groups\TransactionGroupServiceInterface;
use App\Services\Transactions\Partners\PartnerBalanceServiceInterface;
use App\Services\Transactions\Payments\TransactionPaymentServiceInterface;
use App\Services\Transactions\TransactionServiceInterface;
use App\Services\Users\UserServiceInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class TransactionController extends Controller
{
    private TransactionServiceInterface $transactionService;
    private MerchantServiceInterface $merchantService;
    private TransactionGroupServiceInterface $transactionGroupService;
    private MerchantPaymentSystemServiceInterface $mpSystemService;
    private TransactionPaymentServiceInterface $transactionPaymentService;
    private UserServiceInterface $userService;
    private FinancialRecordServiceInterface $financialRecordService;
    private PartnerBalanceServiceInterface $partnerBalanceService;

    public function __construct(TransactionServiceInterface $transactionService,
        MerchantServiceInterface $merchantService,
        TransactionGroupServiceInterface $transactionGroupService,
        MerchantPaymentSystemServiceInterface $mpSystemService,
        TransactionPaymentServiceInterface $transactionPaymentService,
        UserServiceInterface $userService,
        FinancialRecordServiceInterface $financialRecordService,
        PartnerBalanceServiceInterface $partnerBalanceService,)
    {
        $this->transactionService = $transactionService;
        $this->merchantService = $merchantService;
        $this->transactionGroupService = $transactionGroupService;
        $this->mpSystemService = $mpSystemService;
        $this->transactionPaymentService = $transactionPaymentService;
        $this->userService = $userService;
        $this->financialRecordService = $financialRecordService;
        $this->partnerBalanceService = $partnerBalanceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index(): Factory|Application|View
    {
        $transactions = $this->transactionService->getFilteredTransactions();

        $transactions->load('group');
        $merchants = $this->merchantService->getAll();
        $transactionGroups = $this->transactionGroupService->getActiveGroups();
        $users = $this->userService->all();

        return view('admin.transactions.index',
            compact('transactions', 'merchants', 'transactionGroups', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionStoreRequest $request
     * @return TransactionResource
     * @throws Exception
     */
    public function store(TransactionStoreRequest $request): TransactionResource
    {
        try {
            DB::beginTransaction();
            $merchantPayment = $this->mpSystemService->getMerchantPaymentSystem(
                $request->get('payment-systems'),
                $request->get('merchants')
            );

            $transactionDto = TransactionDTO::from([
                ...$request->validated(),
                'merchant_payment_system_id' => $merchantPayment->id,
            ]);

            $transaction = $this->transactionService->store($transactionDto);
            $items = collect($request->input('partial_payments', []))
                ->map(fn ($item, $index) => array_merge($item, [
                    'transaction_id' => $request->filled('parent_id')
                        ? $request->input('parent_id')
                        : $transaction->id,
                    'user_id' => $transactionDto->user_id,
                    'amount' => $item['amount'],
                    'paid_at' => $item['paid_at'] ?? null,
                    'file' => $request->file('partial_payments')[$index]['file'] ?? null,
                    'description' => $item['description'] ?? null,
                ]));

            $transactionPaymentDTO = TransactionPaymentDTO::collect($items);
            $this->transactionPaymentService->store($transactionPaymentDTO);
            $this->partnerBalanceService->shareTransactionsAmount($transaction);

            DB::commit();
            return TransactionResource::make($transaction);
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return Factory|Application|View
     */
    public function show(string $id): Factory|Application|View
    {
        $transaction = $this->transactionService->getById($id);

        return view('admin.transactions.detail', compact('transaction'));
    }

    /**
     * @param int $id
     * @return Factory|Application|View
     */
    public function edit(int $id): Factory|Application|View
    {
        $transaction = $this->transactionService->getById($id);
        $transaction->load('merchantPayment');
        $groups = $this->transactionGroupService->getAll();
        $merchants = $this->merchantService->getAll();
        $merchantPayments = $this->merchantService
            ->getPaymentSystems($transaction->merchantPayment->merchant_id)
            ->load('paymentSystems')->paymentSystems;

        return view('admin.transactions.edit', compact('transaction',
            'groups', 'merchants', 'merchantPayments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, string $id): RedirectResponse
    {
        $transaction = $this->transactionService->getById($id);
        $merchantPayment = $this->mpSystemService->getMerchantPaymentSystem(
            $request->get('payment-systems'),
            $request->get('merchants')
        );

        $transactionDto = TransactionDTO::from([
            ...$request->validated(),
            'merchant_payment_system_id' => $merchantPayment->id,
        ]);

        $this->transactionService->update($transaction->id, $transactionDto);
        $this->partnerBalanceService->shareTransactionsAmount($transaction);

        return redirect()->back()
            ->with('status', 'success')
            ->with('alert', 'İşlem başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->transactionService->destroy($id);

        return redirect()->back()
            ->with('alert', "ID: {$id} numaralı işlem başarıyla silindi.")
            ->with('status', 'success');
    }

    /**
     * @param TransactionExcelExportRequest $request
     * @return BinaryFileResponse
     */
    public function export(TransactionExcelExportRequest $request): BinaryFileResponse
    {
        $dates = explode(' - ', request()->input('filter.requested_at_between'));
        $recordDate['start_date'] = request()->input('filter.requested_at_between', now()->toDateString());
        $recordDate['end_date'] = null;

        if (count($dates) === 2) {
            [$start, $end] = $dates;
            $recordDate['start_date'] = $start;
            $recordDate['end_date'] = $end;
        }

        $transactions = $this->transactionService->getFilteredTransactions();
        $transactions->load('partialPayments', 'subTransactions');

        $financialCriteriaDto = FinancialRecordCriteriaDTO::from([
            'start_date' => $recordDate['start_date'],
            'end_date' => $recordDate['end_date'],
            'transaction_group_id' => request()->input('filter.transaction_group_id'),

        ]);

        $financialRecords = $this->financialRecordService->getByCriteria($financialCriteriaDto);

        $filename = $transactions->first()->group?->name . '-' . $financialCriteriaDto->start_date;

        return Excel::download(new FinanceExport($transactions, $financialRecords), $filename.'.xlsx');
    }
}
