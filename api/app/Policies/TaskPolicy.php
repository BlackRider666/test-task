<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): Response
    {
        return $task->isAuthor($user->getKey()) ?
            $this->allow()
            :
            $this->denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): Response
    {
        return $task->isAuthor($user->getKey()) ?
            $this->allow()
            :
            $this->denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): Response
    {
        if ($task->isAuthor($user->getKey())) {
            return !$task->isCompleted() && !$task->hasCompletedChild() ?
                $this->allow()
                :
                $this->deny('Task or children is already completed');
        }

        return $this->denyAsNotFound();
    }

    public function markAsDone(User $user, Task $task): Response
    {
        if ($task->isAuthor($user->getKey())) {
            if ($task->isCompleted()) {
                return $this->deny('Task is completed');
            }

            if ($task->hasUncompletedChild()) {
                return $this->deny('Task has uncompleted child');
            }

            return $this->allow();
        }

        return $this->denyAsNotFound();
    }
}
