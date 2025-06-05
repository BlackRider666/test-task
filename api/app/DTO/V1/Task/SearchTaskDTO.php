<?php

namespace App\DTO\V1\Task;

use App\Enums\Task\TaskStatusEnum;

class SearchTaskDTO
{
    public function __construct(
        public int $user_id,
        public ?TaskStatusEnum $status,
        public ?int $priority,
        public ?string $q,
        public ?array $sort,
        public ?array $sortBy,
    )
    {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            status: array_key_exists('status',$data) ? TaskStatusEnum::from($data['status']) : null,
            priority: $data['priority'] ?? null,
            q: $data['q'] ?? null,
            sort: $data['sort'] ?? null,
            sortBy: $data['sortBy'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'user_id' => $this->user_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'q' => $this->q,
            'sort' => $this->sort,
            'sortBy' => $this->sortBy,
        ]);
    }
}
