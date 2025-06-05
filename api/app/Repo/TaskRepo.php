<?php

namespace App\Repo;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use RuntimeException;
use App\Enums\Task\TaskStatusEnum;
use App\DTO\V1\Task\{CreateTaskDTO, SearchTaskDTO, UpdateTaskDTO};

class TaskRepo extends CoreRepo
{

    protected function getModelClass(): string
    {
        return Task::class;
    }

    /**
     * @param SearchTaskDTO $searchTaskDTO
     * @return LengthAwarePaginator
     */
    public function search(SearchTaskDTO $searchTaskDTO): LengthAwarePaginator
    {
        $sort = $searchTaskDTO->sort ? : ['created_at'];
        $sortBy = $searchTaskDTO->sortBy ? : ['asc'];

        $query = $this->query();

        $query->when($searchTaskDTO->user_id, function ($query, $userId) {
            $query->where('user_id', $userId);
        });

        $query->when($searchTaskDTO->status, function ($query, $status) {
            $query->where('status', $status->value);
        });

        $query->when($searchTaskDTO->priority, function ($query, $priority) {
            $query->where('priority', $priority);
        });

        $query->when($searchTaskDTO->q, function ($query, $q) {
            $query->whereRaw("MATCH(title,description) AGAINST(? IN BOOLEAN MODE)", $q);
        });

        $query->whereNull('parent_id');

        $query->orderBy($sort[0], $sortBy[0]);
        if (!empty($sort[1]) && !empty($sortBy[1])) {
            $query->orderBy($sort[1], $sortBy[1]);
        }

        return $query->paginate(columns: ['id','status','priority','title','created_at','completed_at','parent_id']);
    }

    /**
     * @param CreateTaskDTO $createTaskDTO
     * @return void
     */
    public function store(CreateTaskDTO $createTaskDTO): void
    {
        if (!$this->query()->create($createTaskDTO->toArray())) {
            throw new RuntimeException('Error creating task');
        }
    }

    /**
     * @param Task $task
     * @param UpdateTaskDTO $updateTaskDTO
     * @return void
     */
    public function update(Task $task, UpdateTaskDTO $updateTaskDTO): void
    {
        if (!$task->update($updateTaskDTO->toArray())) {
            throw new RuntimeException('Error updating task');
        }
    }

    /**
     * @param Task $task
     * @return void
     */
    public function delete(Task $task): void
    {
        if (!$task->delete()) {
            throw new RuntimeException('Error deleting task');
        }
    }

    /**
     * @param Task $task
     * @return void
     */
    public function markAsDone(Task $task): void
    {
        if (!$task->update([
            'status' => TaskStatusEnum::DONE->value,
            'completed_at' => now(),
        ])) {
            throw new RuntimeException('Error marking task as done');
        }
    }
}
