<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
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
            'title' => fake()->realTextBetween($minNbChars = 10, $maxNbChars = 40, $indexSize = 2),
            'description' => fake()->realTextBetween($minNbChars = 50, $maxNbChars = 400, $indexSize = 2),
            'completed' => fake()->boolean(),
            'endtime' => fake()->dateTimeBetween('-10 week', '+1 year')
        ];
    }
}
