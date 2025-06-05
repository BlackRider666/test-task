<?php

namespace App\Http\Resources\API\V1\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="BaseTaskResource",
 *     @OA\Property(
 *       property="id",
 *       type="integer",
 *       example="21"
 *     ),
 *     @OA\Property(
 *       property="status",
 *       type="string",
 *       example="todo"
 *     ),
 *     @OA\Property(
 *      property="priority",
 *      type="integer",
 *      example="3"
 *     ),
 *     @OA\Property(
 *      property="title",
 *      type="string",
 *      example="Title"
 *     ),
 *     @OA\Property(
 *      property="createdAt",
 *      type="string",
 *      format="datetime",
 *      example="18:03:33 05-06-2025"
 *     ),
 *     @OA\Property(
 *      property="completedAt",
 *      type="string",
 *      format="datetime",
 *      example="18:03:33 05-06-2025"
 *     )
 * )
 */
class BaseTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title'    => $this->title,
            'createdAt' => $this->created_at->format('H:i:s d-m-Y'),
            'completedAt' => $this->completed_at,
        ];
    }
}
