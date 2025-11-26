<?php

namespace App\Repositories\Wallets;

use App\DTO\Wallets\WalletDTO;
use App\Models\Wallets\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface WalletRepositoryInterface
{
    public function all(): LengthAwarePaginator;
    public function findById(int $id): ?Wallet;
    public function findByUserId(int $userId): Collection;
    public function create(WalletDTO $walletDTO): Wallet;
    public function update(int $id, array $data): Wallet;
    public function delete(int $id): bool;
}
