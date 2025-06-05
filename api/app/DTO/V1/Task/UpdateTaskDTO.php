<?php

namespace App\DTO\V1\Task;

class UpdateTaskDTO
{
    public function __construct(
        public int $priority,
        public string $title,
        public string $description,
        public ?int $parent_id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            priority: $data['priority'],
            title: $data['title'],
            description: $data['description'],
            parent_id: $data['parent_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ];
    }
}
