<?php

namespace App\Http\Requests\API\V1\Auth;

use App\DTO\V1\Auth\LoginDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginRequest",
 *     required={"email", "password"},
 *     @OA\Property(
 *      property="email",
 *      type="string",
 *      format="email",
 *      example="demo1@demo.com"
 *     ),
 *     @OA\Property(
 *      property="password",
 *      type="string",
 *      format="password",
 *      example="password"
 *     )
 * )
 */
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];
    }

    /**
     * @return LoginDTO
     */
    public function toDTO(): LoginDTO
    {
        return LoginDTO::fromArray($this->validated());
    }
}
