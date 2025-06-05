<?php

namespace App\Enums\Task;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TaskSortEnum",
 *     type="string",
 *     enum={"priority", "created_at", "completed_at"},
 *     description="Available field for sorting"
 * )
 */
enum TaskSortEnum: string
{
    case PRIORITY = 'priority';

    case CREATED_AT = 'created_at';

    case COMPLETED_AT = 'completed_at';
}
