<?php

namespace App\Repositories\Wallets;

use App\DTO\Wallets\WalletDTO;
use App\Models\Wallets\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class WalletRepository implements WalletRepositoryInterface
{
    protected Wallet $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->wallet->newQuery()->latest()->paginate(21);
    }

    /**
     * @param int $id
     * @return Wallet|null
     */
    public function findById(int $id): ?Wallet
    {
        return $this->wallet->newQuery()->find($id);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function findByUserId(int $userId): Collection
    {
        return $this->wallet->newQuery()->where('user_id', $userId)->get();
    }

    /**
     * @param WalletDTO $walletDTO
     * @return Wallet
     */
    public function create(WalletDTO $walletDTO): Wallet
    {
        return $this->wallet->newQuery()->create($walletDTO->toArray());
    }

    /**
     * @param int $id
     * @param array $data
     * @return Wallet
     */
    public function update(int $id, array $data): Wallet
    {
        $wallet = $this->findById($id);
        $wallet->update($data);

        return $wallet;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->wallet->newQuery()->where('id', $id)->delete();
    }
}
