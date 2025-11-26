<?php

namespace App\Repositories\Tasks;

use App\DTO\Tasks\TaskDTO;
use App\Models\Tasks\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function getAllPaginated(): LengthAwarePaginator;
    public function create(TaskDTO $taskDTO): Task;
    public function update(int $id, array $data): Task;
    public function findById(int $id): ?Task;
    public function delete(int $id): bool;
}
