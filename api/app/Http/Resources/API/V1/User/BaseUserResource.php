<?php

namespace App\Http\Resources\API\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="BaseUserResource",
 *     @OA\Property(
 *      property="name",
 *      type="string",
 *      example="Name"
 *     ),
 *     @OA\Property(
 *       property="email",
 *       type="string",
 *       example="demo@demo.com"
 *      )
 * )
 */
class BaseUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }
}
