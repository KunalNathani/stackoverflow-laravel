<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence(random_int(5, 10)), '.'),
            'body' => $this->faker->paragraphs(random_int(3, 8), true),
            'views_count' => random_int(0, 10),
            'votes_count' => random_int(-10, 10),
        ];
    }
}
