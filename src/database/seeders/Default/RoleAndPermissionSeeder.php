<?php

namespace Database\Seeders\Default;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
    }
}
