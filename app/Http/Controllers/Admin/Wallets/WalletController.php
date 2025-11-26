<?php

namespace App\Http\Controllers\Admin\Wallets;

use App\DTO\Wallets\WalletDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Wallets\StoreWalletRequest;
use App\Services\Users\UserServiceInterface;
use App\Services\Wallets\WalletServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function __construct(
        protected WalletServiceInterface $walletService,
        protected UserServiceInterface $userService
    ) {}

    /**
     * @return Factory|Application|View
     */
    public function index(): Factory|Application|View
    {
        $wallets = $this->walletService->getAllWallets();

        return view('admin.wallets.index', compact('wallets'));
    }

    /**
     * @return Factory|Application|View
     */
    public function create(): Factory|Application|View
    {
        $users = $this->userService->all();

        return view('admin.wallets.create', compact('users'));
    }

    /**
     * @param StoreWalletRequest $request
     * @return RedirectResponse
     */
    public function store(StoreWalletRequest $request): RedirectResponse
    {
        $walletDTO = WalletDTO::from($request);
        $this->walletService->createWallet($walletDTO);

        return redirect()->back()
            ->with('status', 'success')
            ->with('alert', 'Cüzdan başarıyla oluşturuldu.');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->walletService->deleteWallet($id);

        return redirect()->back()->with('status', 'success')->with('alert', 'Cüzdan silindi.');
    }

    /**
     * @param int $id
     * @param int $active
     * @return RedirectResponse
     */
    public function active(int $id, int $active): RedirectResponse
    {
        $walletDTO = new WalletDTO();
        $walletDTO->active = $active;

        $this->walletService->updateWalletActive($id, $walletDTO);

        return redirect()->back()->with('status', 'success')->with('alert', 'Durum güncellendi.');
    }
}
