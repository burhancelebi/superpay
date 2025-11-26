<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Models\Tasks\Task;
use App\Repositories\Tasks\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService implements TaskServiceInterface
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(): LengthAwarePaginator
    {
        return $this->taskRepository->getAllPaginated();
    }

    /**
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function create(TaskDTO $taskDTO): Task
    {
        return $this->taskRepository->create($taskDTO);
    }

    /**
     * @param int $id
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function update(int $id, TaskDTO $taskDTO): Task
    {
        return $this->taskRepository->update($id, $taskDTO->onlyFilled());
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function findById(int $id): ?Task
    {
        return $this->taskRepository->findById($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }

    /**
     * @param int $id
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function updateTaskActive(int $id, TaskDTO $taskDTO): Task
    {
        return $this->taskRepository->update($id, ['active' => $taskDTO->active]);
    }
}
