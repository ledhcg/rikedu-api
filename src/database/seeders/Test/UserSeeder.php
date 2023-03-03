<?php

namespace Database\Seeders\Test;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        User::factory()
            ->hasPosts(25)
            ->create([
                'username' => 'admin',
                'email' => 'admin@ledinhcuong.com',
                'password' => bcrypt('password'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'bio' => $faker->sentence(),
                'image' => $faker->imageUrl(640, 480),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'date_of_birth' => $faker->date(),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'department' => $faker->word,
                'active' => $faker->boolean(),
                'last_login' => $faker->dateTimeBetween('-1 day', 'now'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

        User::factory()
            ->hasPosts(25)
            ->create([
                'username' => 'user',
                'email' => 'user@ledinhcuong.com',
                'password' => bcrypt('password'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'bio' => $faker->sentence(),
                'image' => $faker->imageUrl(640, 480),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'date_of_birth' => $faker->date(),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'department' => $faker->word,
                'active' => $faker->boolean(),
                'last_login' => $faker->dateTimeBetween('-1 day', 'now'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

        User::factory(5)
            ->superAdmin()
            ->hasPosts(25)
            ->create();
        User::factory(50)
            ->admin()
            ->hasPosts(25)
            ->create();
        User::factory(50)
            ->hasPosts(25)
            ->create();
    }
}
