<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\API\V1\Role;
use App\Models\User;
use App\Models\API\V1\Permission;

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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
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
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $adminRole = Role::findByName('admin');

            $createPostsPermission = Permission::findByName('create posts');
            $updateAnyPostPermission = Permission::findByName('update any post');
            $deleteAnyPostPermission = Permission::findByName('delete any post');

            // Assign roles and permissions to the user
            $user->assignRole($adminRole);
            $user->givePermissionTo($createPostsPermission);
            $user->givePermissionTo($updateAnyPostPermission);
            $user->givePermissionTo($deleteAnyPostPermission);
        });
    }
}