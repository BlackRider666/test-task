<?php

namespace App\DTO\V1\Task;

use App\Enums\Task\TaskStatusEnum;

class CreateTaskDTO
{
    public function __construct(
        public int $user_id,
        public int $priority,
        public string $title,
        public string $description,
        public TaskStatusEnum $status,
        public ?int $parent_id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            priority: $data['priority'],
            title: $data['title'],
            description: $data['description'],
            status: TaskStatusEnum::TODO,
            parent_id: $data['parent_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
            'status'      => $this->status->value,
            'parent_id'   => $this->parent_id
        ];
    }
}
