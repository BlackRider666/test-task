<?php

namespace Database\Factories;

use App\Enums\Task\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'user_id' => null,
            'status'    => TaskStatusEnum::TODO->value,
            'priority'  => $this->faker->numberBetween(1, 5),
            'title'     => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
        ];
    }

    public function withChildren(int $countOnLevel = 10, int $depth = 3): self
    {
        return $this->afterCreating(function (Task $task) use ($countOnLevel, $depth) {
            if ($depth <= 0) {
                return;
            }

            Task::factory()
                ->count($countOnLevel)
                ->state([
                    'user_id' => $task->user_id,
                    'parent_id' => $task->id,
                ])
                ->withChildren($countOnLevel, $depth - 1)
                ->create();
        });
    }
}
