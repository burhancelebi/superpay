<?php

namespace App\Services\Wallets;

use App\DTO\Wallets\WalletDTO;
use App\Models\Wallets\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface WalletServiceInterface
{
    public function getAllWallets(): LengthAwarePaginator;
    public function getWalletById(int $id): ?Wallet;
    public function getUserWallets(int $userId): Collection;
    public function createWallet(WalletDTO $walletDTO): Wallet;
    public function updateWalletActive(int $id, WalletDTO $walletDTO): Wallet;
    public function deleteWallet(int $id): bool;
}
