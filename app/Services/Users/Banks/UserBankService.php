<?php

namespace App\Services\Users\Banks;

use App\DTO\Users\UserBankDTO;
use App\Models\Users\UserBank;
use App\Repositories\Users\Banks\UserBankRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserBankService implements UserBankServiceInterface
{
    protected UserBankRepositoryInterface $userBankRepository;

    public function __construct(UserBankRepositoryInterface $userBankRepository)
    {
        $this->userBankRepository = $userBankRepository;
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->userBankRepository->getByUserId($userId);
    }

    /**
     * @param UserBankDTO $bankDTO
     * @return UserBank
     */
    public function create(UserBankDTO $bankDTO): UserBank
    {
        return $this->userBankRepository->create($bankDTO);
    }

    /**
     * @param int $id
     * @return UserBank|null
     */
    public function findById(int $id): ?UserBank
    {
        return $this->userBankRepository->findById($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->userBankRepository->delete($id);
    }
}
