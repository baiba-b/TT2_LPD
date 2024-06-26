<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
       /**
     * Indicate that the project's due date is in the past.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pastDueDate()
    {
        return $this->state(function (array $attributes) {
            return [
                'due_date' => Carbon::yesterday(), // Set due date to yesterday
            ];
        });
    }
   
}
