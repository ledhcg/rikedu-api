<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'bio' => $this->faker->sentence(),
            'image' => 'https://picsum.photos/seed/avatar/600/600.webp',
            'gender' => $this->faker->randomElement([
                'Male',
                'Female',
                'Other',
            ]),
            'date_of_birth' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'department' => $this->faker->word,
            'active' => $this->faker->boolean(),
            'last_login' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(
            fn(array $attributes) => [
                'email_verified_at' => null,
            ]
        );
    }

    /**
     * Indicate that the user is a teacher.
     *
     * @return Factory
     */
    public function teacher(): UserFactory
    {
        return $this->assignRole('teacher');
    }

    /**
     * Indicate that the user is a student.
     *
     * @return Factory
     */
    public function student(): UserFactory
    {
        return $this->assignRole('student');
    }

    /**
     * Indicate that the user is a parent.
     *
     * @return Factory
     */
    public function parent(): UserFactory
    {
        return $this->assignRole('parent');
    }

    /**
     * Indicate that the user is a user.
     *
     * @return Factory
     */
    public function user(): UserFactory
    {
        return $this->assignRole('user');
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return Factory
     */
    public function admin(): UserFactory
    {
        return $this->assignRole('admin');
    }

    /**
     * Indicate that the user is a super admin.
     *
     * @return Factory
     */
    public function superAdmin(): UserFactory
    {
        return $this->assignRole('super admin');
    }

    /**
     * @param array|\Spatie\Permission\Contracts\Role|string  ...$roles
     * @return UserFactory
     */
    private function assignRole(...$roles): UserFactory
    {
        return $this->afterCreating(fn(User $user) => $user->syncRoles($roles));
    }

    // /**
    //  * Configure the model factory.
    //  *
    //  * @return $this
    //  */
    // public function configure()
    // {
    //     return $this->afterMaking(function (User $user) {
    //         return $user->assignRole('user');
    //     });
    // }
}
