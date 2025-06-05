<?php

namespace App\Http\Requests\API\V1\Task;

use App\DTO\V1\Task\SearchTaskDTO;
use App\Enums\Core\SortByEnum;
use App\Enums\Task\TaskSortEnum;
use App\Enums\Task\TaskStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', Rule::enum(TaskStatusEnum::class)],
            'priority' => ['nullable', 'integer', 'between:1,5'],
            'q'        => ['nullable', 'string', 'max:255'],
            'sort'     => ['nullable','array','max:2'],
            'sort.*'   => ['string', Rule::enum(TaskSortEnum::class)],
            'sortBy'   => ['nullable','array','max:2'],
            'sortBy.*' => [Rule::enum(SortByEnum::class)],
        ];
    }

    public function toDTO(): SearchTaskDTO
    {
        return SearchTaskDTO::fromArray([...$this->validated(), 'user_id' => $this->user('api')->getKey()]);
    }
}
