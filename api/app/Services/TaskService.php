<?php

namespace App\Services;

use App\Repo\TaskRepo;
use App\DTO\V1\Task\{CreateTaskDTO, MarkAsDoneTaskDTO, SearchTaskDTO, UpdateTaskDTO};
use App\Models\Task;

class TaskService
{
    private TaskRepo $repo;

    public function __construct()
    {
        $this->repo = new TaskRepo();
    }

    public function search(SearchTaskDTO $searchTaskDTO)
    {
        return $this->repo->search($searchTaskDTO);
    }

    /**
     * @param CreateTaskDTO $createTaskDTO
     * @return void
     */
    public function create(CreateTaskDTO $createTaskDTO): void
    {
        $this->repo->store($createTaskDTO);
    }

    /**
     * @param Task $task
     * @return Task
     */
    public function loadRelations(Task $task): Task
    {
        return $task->load('children');
    }

    /**
     * @param Task $task
     * @param UpdateTaskDTO $updateTaskDTO
     * @return void
     */
    public function update(Task $task, UpdateTaskDTO $updateTaskDTO): void
    {
        $this->repo->update($task, $updateTaskDTO);
    }

    /**
     * @param Task $task
     * @return void
     */
    public function delete(Task $task): void
    {
        $this->repo->delete($task);
    }

    /**
     * @param Task $task
     * @return void
     */
    public function markAsDone(Task $task): void
    {
        $this->repo->markAsDone($task);
    }
}
