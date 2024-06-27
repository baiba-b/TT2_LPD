<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'estimated_workload' => $this->faker->numberBetween(1, 480), // workload in minutes
            'invested_time' => $this->faker->numberBetween(0, 480), // time invested in minutes
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'project_id' => \App\Models\Project::factory(), // Assuming you have a Project factory
            'creator_id' => User::factory()
        ];
    }
}
