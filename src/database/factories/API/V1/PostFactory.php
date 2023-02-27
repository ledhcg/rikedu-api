<?php

namespace Database\Factories\API\V1;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\API\V1\Post;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\API\V1\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
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