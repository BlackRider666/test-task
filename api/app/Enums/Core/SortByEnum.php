<?php

namespace App\Enums\Core;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="SortByEnum",
 *     type="string",
 *     enum={"asc", "desc"},
 *     description="Allowed values for sorting"
 * )
 */
enum SortByEnum: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
