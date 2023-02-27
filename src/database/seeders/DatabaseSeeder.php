<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API\V1\Role;
use App\Models\API\V1\Permission;

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
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $createPostsPermission = Permission::create(['name' => 'create posts']);

        $updateOwnPostsPermission = Permission::create(['name' => 'update own posts']);
        $deleteOwnPostsPermission = Permission::create(['name' => 'delete own posts']);
        
        $updateAnyPostPermission = Permission::create(['name' => 'update any post']);
        $deleteAnyPostPermission = Permission::create(['name' => 'delete any post']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($createPostsPermission);
        $adminRole->givePermissionTo($updateAnyPostPermission);
        $adminRole->givePermissionTo($deleteAnyPostPermission);

        $userRole->givePermissionTo($updateOwnPostsPermission);
        $userRole->givePermissionTo($deleteOwnPostsPermission);
        
        \App\Models\User::factory(10)->hasPosts(25)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}