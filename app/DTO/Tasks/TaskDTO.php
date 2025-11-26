<?php

namespace App\DTO\Tasks;

use App\DTO\DtoHelper;
use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypeEnum;
use Spatie\LaravelData\Data;

class TaskDTO extends Data
{
    use DtoHelper;

    public function __construct(
        public ?string $title = null,
        public ?string $duration = null,
        public ?float $amount = 0.0,
        public ?float $reward = 0.0,
        public ?int $active = null,
        public ?TaskStatusEnum $status = TaskStatusEnum::OPEN,
        public ?TaskTypeEnum $type = null,
        public ?int $score = null,
        public ?int $wallet_id = null,
        public ?string $description = null,
    ) {
    }
}
