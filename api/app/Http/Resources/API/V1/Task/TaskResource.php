<?php

namespace App\Http\Resources\API\V1\Task;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TaskResource",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/BaseTaskResource"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="description",
 *                 type="string",
 *                 example="Long desc"
 *             ),
 *             @OA\Property(
 *                  property="children",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/TaskResource")
 *              )
 *         )
 *     }
 * )
 */
class TaskResource extends BaseTaskResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'description' => $this->description,
            'children' => TaskResource::collection($this->whenLoaded('children'))
        ]);
    }
}
