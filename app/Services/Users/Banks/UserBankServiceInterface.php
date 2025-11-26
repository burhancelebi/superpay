<?php

namespace App\Services\Users\Banks;

use App\DTO\Users\UserBankDTO;
use App\Models\Users\UserBank;
use Illuminate\Database\Eloquent\Collection;

interface UserBankServiceInterface
{
    public function getByUserId(int $userId): Collection;
    public function create(UserBankDTO $bankDTO): UserBank;
    public function findById(int $id): ?UserBank;
    public function delete(int $id): bool;
}
