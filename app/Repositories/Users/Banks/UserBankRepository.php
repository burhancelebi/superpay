<?php

namespace App\Repositories\Users\Banks;

use App\Models\Users\UserBank;
use Illuminate\Database\Eloquent\Collection;

interface UserBankRepositoryInterface
{
    public function getByUserId(int $userId): Collection;
    public function create(array $data): UserBank;
    public function findById(int $id): ?UserBank;
    public function delete(int $id): bool;
}
