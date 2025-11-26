<?php

namespace App\Repositories\Users;

use App\DTO\Users\UserDTO;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function all(): LengthAwarePaginator;
    public function create(UserDTO $userDTO): User|Model;
    public function findById(int $id): User|Collection|Model|null;
    public function findByEmail(string $email): User|Collection|Model|null;
    public function updateStatus(int $id, string $status): User|Collection|Model|null;
    public function updatePassword(string $email, string $password): User|Collection|Model|null;
}
