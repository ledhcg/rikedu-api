<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\About;
use Illuminate\Database\Seeder;

use Database\Seeders\Default\RoleAndPermissionSeeder;
use Database\Seeders\Default\InfoSeeder;

use Database\Seeders\Test\CategorySeeder;
use Database\Seeders\Test\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //Default
            InfoSeeder::class,
            RoleAndPermissionSeeder::class,
            //Test
            CategorySeeder::class,
            UserSeeder::class,
        ]);
    }
}
