<?php

namespace App\Enums\Task;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TaskStatusEnum",
 *     type="string",
 *     enum={"todo", "done"},
 *     description="Task Status"
 * )
 */
enum TaskStatusEnum : string
{
    case TODO = 'todo';

    case DONE = 'done';
}
