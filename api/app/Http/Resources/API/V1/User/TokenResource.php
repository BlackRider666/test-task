<?php

namespace App\Http\Resources\API\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TokenResource",
 *     @OA\Property(
 *      property="token",
 *      type="string",
 *      example="your_token"
 *     )
 * )
 */
class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->createToken(config('app.name'))->plainTextToken
        ];
    }
}
