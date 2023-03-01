<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Faker\Factory as Faker;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $superAdminRole = Role::create(['name' => 'super admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $anythingPermission = Permission::create(['name' => 'anything']);

        $createPostsPermission = Permission::create(['name' => 'create posts']);

        $updateOwnPostsPermission = Permission::create([
            'name' => 'update own posts',
        ]);
        $deleteOwnPostsPermission = Permission::create([
            'name' => 'delete own posts',
        ]);

        $updateAnyPostPermission = Permission::create([
            'name' => 'update any post',
        ]);
        $deleteAnyPostPermission = Permission::create([
            'name' => 'delete any post',
        ]);

        // Assign permissions to roles
        $superAdminRole->givePermissionTo($anythingPermission);

        $adminRole->givePermissionTo($createPostsPermission);
        $adminRole->givePermissionTo($updateAnyPostPermission);
        $adminRole->givePermissionTo($deleteAnyPostPermission);

        $userRole->givePermissionTo($updateOwnPostsPermission);
        $userRole->givePermissionTo($deleteOwnPostsPermission);
        
        $faker = Faker::create();
        
        User::factory()->hasPosts(25)->create([
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
        

        User::factory()->hasPosts(25)->create([
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
        
        User::factory(5)->superAdmin()->hasPosts(25)->create();
        User::factory(50)->admin()->hasPosts(25)->create();
        User::factory(50)->hasPosts(25)->create();
    }
}