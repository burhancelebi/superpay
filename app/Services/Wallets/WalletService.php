<?php

namespace App\Services\Wallets;

use App\DTO\Wallets\WalletDTO;
use App\Models\Wallets\Wallet;
use App\Repositories\Wallets\WalletRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class WalletService implements WalletServiceInterface
{
    public function __construct(
        protected WalletRepositoryInterface $walletRepository
    ) {}

    /**
     * @return LengthAwarePaginator
     */
    public function getAllWallets(): LengthAwarePaginator
    {
        return $this->walletRepository->all();
    }

    /**
     * @param int $id
     * @return Wallet|null
     */
    public function getWalletById(int $id): ?Wallet
    {
        return $this->walletRepository->findById($id);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserWallets(int $userId): Collection
    {
        return $this->walletRepository->findByUserId($userId);
    }

    /**
     * @param WalletDTO $walletDTO
     * @return Wallet
     */
    public function createWallet(WalletDTO $walletDTO): Wallet
    {
        return $this->walletRepository->create($walletDTO);
    }

    /**
     * @param int $id
     * @param WalletDTO $walletDTO
     * @return Wallet
     */
    public function updateWalletActive(int $id, WalletDTO $walletDTO): Wallet
    {
        return $this->walletRepository->update($id, ['active' => $walletDTO->active]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteWallet(int $id): bool
    {
        return $this->walletRepository->delete($id);
    }
}
