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
            ->superAdmin()
            ->hasPosts(25)
            ->create([
                'username' => 'superadmin',
                'email' => 'superadmin@bcsdnga.com',
                'password' => bcrypt('password'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'bio' => $faker->sentence(),
                'image' => 'https://picsum.photos/seed/avatar/600/600.webp',
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
            ->admin()
            ->hasPosts(25)
            ->hasAbouts(5)
            ->create([
                'username' => 'admin',
                'email' => 'admin@bcsdnga.com',
                'password' => bcrypt('password'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'bio' => $faker->sentence(),
                'image' => 'https://picsum.photos/seed/avatar/600/600.webp',
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
            ->user()
            ->hasPosts(25)
            ->create([
                'username' => 'user',
                'email' => 'user@bcsdnga.com',
                'password' => bcrypt('password'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'bio' => $faker->sentence(),
                'image' => 'https://picsum.photos/seed/avatar/600/600.webp',
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
            ->admin()
            ->hasPosts(25)
            ->create();

        User::factory(50)
            ->user()
            ->hasPosts(25)
            ->create();
    }
}
