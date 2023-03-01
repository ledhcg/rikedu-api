<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'thumbnail' => $this->faker->imageUrl(640, 480),
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraphs(3, true),
            'summary' => $this->faker->paragraph,
            'published' => $this->faker->boolean,
            'published_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}