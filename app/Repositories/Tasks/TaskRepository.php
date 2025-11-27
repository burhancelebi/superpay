<?php

namespace App\Repositories\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\enums\Tasks\TaskStatusEnum;
use App\Models\Tasks\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getActiveTasks(): LengthAwarePaginator
    {
        return $this->task->newQuery()
            ->where('status', TaskStatusEnum::OPEN)
            ->paginate(20);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(): LengthAwarePaginator
    {
        return $this->task->newQuery()
            ->latest()
            ->paginate(20);
    }

    /**
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function create(TaskDTO $taskDTO): Task
    {
        return $this->task->newQuery()->create($taskDTO->toArray());
    }

    /**
     * @param int $id
     * @param array $data
     * @return Task
     */
    public function update(int $id, array $data): Task
    {
        $task = $this->findById($id);
        $task->update($data);

        return $task;
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function findById(int $id): ?Task
    {
        return $this->task->newQuery()->findOrFail($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->task->newQuery()->findOrFail($id)->delete();
    }
}
