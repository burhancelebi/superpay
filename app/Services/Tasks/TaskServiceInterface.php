<?php

namespace App\Services\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Models\Tasks\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function getActiveTasks(): LengthAwarePaginator;
    public function getAllPaginated(): LengthAwarePaginator;
    public function create(TaskDTO $taskDTO): Task;
    public function update(int $id, TaskDTO $taskDTO): Task;
    public function findById(int $id): ?Task;
    public function delete(int $id): bool;
    public function updateTaskActive(int $id, TaskDTO $taskDTO): Task;
}
