<?php

namespace App\Repositories\Users\Banks;

use App\DTO\Users\UserBankDTO;
use App\Models\Users\UserBank;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserBankRepository implements UserBankRepositoryInterface
{
    protected UserBank $model;

    public function __construct(UserBank $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $userId
     * @return LengthAwarePaginator
     */
    public function getByUserId(int $userId): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->paginate(21);
    }

    /**
     * @param UserBankDTO $bankDTO
     * @return UserBank
     */
    public function create(UserBankDTO $bankDTO): UserBank
    {
        return $this->model->newQuery()->create($bankDTO->toArray());
    }

    /**
     * @param int $id
     * @return UserBank|null
     */
    public function findById(int $id): ?UserBank
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $bank = $this->findById($id);

        if ($bank) {
            return $bank->delete();
        }

        return false;
    }
}
