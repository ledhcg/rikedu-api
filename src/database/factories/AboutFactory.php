<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => $slug,
            'image' => 'https://picsum.photos/1200/600.webp',
            'content' => $this->faker->paragraphs(60, true),
            'summary' => $this->faker->paragraph,
            'published_at' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
