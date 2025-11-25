<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use App\Models\Merchants\Merchant;
use App\Models\Customer;
use App\Services\Customers\CustomerServiceInterface;
use App\Services\Transactions\TransactionServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    private CustomerServiceInterface $customerService;
    private TransactionServiceInterface $transactionService;

    public function __construct(CustomerServiceInterface $customerService,
                                TransactionServiceInterface $transactionService)
    {
        $this->customerService = $customerService;
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Merchant $company
     * @return Factory|Application|View
     */
    public function companyCustomers(Request $request, Merchant $company): Factory|Application|View
    {
        Gate::authorize('customerList', $company);
        $customers = $this->customerService->getByCompanyId($company);

        return view('admin.customers.index', compact('customers', 'company'));
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return View|Application|Factory
     */
    public function show(string $id): View|Application|Factory
    {
        $customer = $this->customerService->findById($id);
        $transactions = $this->transactionService->getByCustomer($customer);

        return view('admin.customers.detail', compact('customer', 'transactions'));
    }
}
