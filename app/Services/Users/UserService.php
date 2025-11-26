<?php

namespace App\Services\Users;

use App\DTO\Users\UserDTO;
use App\Models\Users\User;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->userRepository->all();
    }

    /**
     * @param int $id
     * @return User|Collection|Model|null
     */
    public function findById(int $id): User|Collection|Model|null
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @param string $email
     * @return User|Collection|Model|null
     */
    public function findByEmail(string $email): User|Collection|Model|null
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * @param int $id
     * @param int $status
     * @return User|Collection|Model|null
     */
    public function updateStatus(int $id, int $status): Model|Collection|User|null
    {
        return $this->userRepository->updateStatus($id, $status);
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|Model|null
     */
    public function updatePassword(string $email, string $password): User|Model|null
    {
        return $this->userRepository->updatePassword($email, $password);
    }

    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function create(UserDTO $userDTO): User
    {
        return $this->userRepository->create($userDTO);
    }
}
