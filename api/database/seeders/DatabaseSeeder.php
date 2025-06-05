<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $countOnLevel = 5;
        User::factory()
            ->count(100)
            ->sequence(fn ($sequence) => [
                'email' => 'demo' . ($sequence->index + 1) . '@demo.com',
            ])
            ->has(
                Task::factory()
                    ->count($countOnLevel)
                    ->withChildren($countOnLevel,3) // formula total of task is -  Σ(countOnLevel^i) - where i = 1 to depth
                //in this case 1 user have 160 tasks an 16000 for all
                ,'tasks')
            ->create();
    }
}
