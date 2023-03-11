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
        // 1.Create roles
        $superAdminRole = Role::create(['name' => 'super admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // 2.Create permissions
        // 2.1 Post
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

        // 2.2 About
        $createAboutsPermission = Permission::create([
            'name' => 'create abouts',
        ]);
        $updateOwnAboutsPermission = Permission::create([
            'name' => 'update own abouts',
        ]);
        $deleteOwnAboutsPermission = Permission::create([
            'name' => 'delete own abouts',
        ]);
        $updateAnyAboutPermission = Permission::create([
            'name' => 'update any about',
        ]);
        $deleteAnyAboutPermission = Permission::create([
            'name' => 'delete any about',
        ]);

        // 3. Assign permissions to roles
        $superAdminRole->givePermissionTo($anythingPermission);

        // 3.1 Post
        $adminRole->givePermissionTo($createPostsPermission);
        $adminRole->givePermissionTo($updateAnyPostPermission);
        $adminRole->givePermissionTo($deleteAnyPostPermission);

        $userRole->givePermissionTo($updateOwnPostsPermission);
        $userRole->givePermissionTo($deleteOwnPostsPermission);

        // 3.2 About
        $adminRole->givePermissionTo($createAboutsPermission);
        $adminRole->givePermissionTo($updateAnyAboutPermission);
        $adminRole->givePermissionTo($deleteAnyAboutPermission);

        $userRole->givePermissionTo($updateOwnAboutsPermission);
        $userRole->givePermissionTo($deleteOwnAboutsPermission);
    }
}
