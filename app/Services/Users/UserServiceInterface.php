<?php

namespace App\Services\Users;

use App\DTO\Users\UserDTO;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function all(): LengthAwarePaginator;
    public function findById(int $id): User|Collection|Model|null;
    public function findByEmail(string $email): User|Collection|Model|null;
    public function updateStatus(int $id, int $status): Model|Collection|User|null;
    public function updatePassword(string $email, string $password): User|Model|null;
    public function create(UserDTO $userDTO): User;
}
