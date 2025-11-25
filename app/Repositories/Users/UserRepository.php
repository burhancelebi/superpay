<?php

namespace App\Repositories\Users;

use App\DTO\UserDTO;
use App\Enums\ActiveEnum;
use App\Enums\Users\UserRoleEnum;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->user->newQuery()
            ->when(request()->filled('email'), function ($query) {
                $query->where('email', request()->input('email'));
            })->paginate(20);
    }

    /**
     * @param UserDTO $userDTO
     * @return User|Model
     */
    public function create(UserDTO $userDTO): User|Model
    {
        return $this->user->newQuery()->create($userDTO->toArray());
    }

    /**
     * @param int $id
     * @return User|Collection|Model|null
     */
    public function findById(int $id): User|Collection|Model|null
    {
        return $this->user->newQuery()->find($id);
    }

    /**
     * @param string $email
     * @return User|Collection|Model|null
     */
    public function findByEmail(string $email): User|Collection|Model|null
    {
        return $this->user->newQuery()->where('email', $email)->first();
    }

    /**
     * @param int $id
     * @param string $status
     * @return User|Collection|Model|null
     */
    public function updateStatus(int $id, string $status): User|Collection|Model|null
    {
        $user = $this->findById($id);
        $user->active = $status;
        $user->save();

        return $user;
    }

    /**
     * @param $email
     * @param string $password
     * @return User|Collection|Model|null
     */
    public function updatePassword($email, string $password): User|Collection|Model|null
    {
        $user = $this->findByEmail($email);
        $user->password = Hash::make($password);
        $user->save();

        return $user;
    }
}
