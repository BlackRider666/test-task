<?php

namespace App\Http\Requests\API\V1\Task;

use App\DTO\V1\Task\UpdateTaskDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UpdateTaskRequest",
 *     required={"priority", "title", "description"},
 *     @OA\Property(
 *       property="parent_id",
 *       type="integer",
 *       example="Parent ID"
 *      ),
 *     @OA\Property(
 *      property="title",
 *      type="string",
 *      example="New task"
 *     ),
 *     @OA\Property(
 *      property="description",
 *      type="string",
 *      example="Do something important"
 *     ),
 *     @OA\Property(
 *      property="priority",
 *      type="integer",
 *      minimum=1,
 *      maximum=5,
 *      example=3
 *     )
 * )
 */
class UpdateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' =>  ['nullable', 'int', 'exists:tasks,id'],
            'priority'  =>  ['required', 'int', 'between:1,5'],
            'title'     =>  ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
        ];
    }

    public function toDTO(): UpdateTaskDTO
    {
        return UpdateTaskDTO::fromArray($this->validated());
    }
}
