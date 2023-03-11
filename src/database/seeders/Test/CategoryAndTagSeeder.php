<?php

namespace Database\Seeders\Test;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;
use App\Models\Post;

class CategoryAndTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Category::factory(5)->create();
        Category::factory()->create([
            'title' => 'News',
            'slug' => 'news',
            'description' => $faker->paragraphs(3, true),
        ]);
        Category::factory()->create([
            'title' => 'Posts',
            'slug' => 'posts',
            'description' => $faker->paragraphs(3, true),
        ]);
        Category::factory()->create([
            'title' => 'Other',
            'slug' => 'other',
            'description' => $faker->paragraphs(3, true),
        ]);

        foreach (Post::all() as $post) {
            $category = Category::inRandomOrder()->first();
            $post->attachCategory($category->slug);

            $tags_example = [
                'Travel',
                'Foodie',
                'Fitness',
                'Photography',
                'Fashion',
                'Nature',
                'Technology',
                'Music',
                'Art',
                'SelfImprovement',
                'Health',
                'Beauty',
                'Pets',
                'Books',
                'Movies',
                'Sports',
                'Education',
                'Business',
                'Marketing',
                'Entrepreneurship',
            ];

            $keys = array_rand($tags_example, 3);
            $tags = [
                $tags_example[$keys[0]],
                $tags_example[$keys[1]],
                $tags_example[$keys[2]],
            ];

            $post->attachTags($tags);
        }
    }
}
