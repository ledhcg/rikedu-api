<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Default\InfoSeeder;
use Database\Seeders\Default\RoleAndPermissionSeeder;
use Database\Seeders\Test\CategoryAndTagSeeder;
use Database\Seeders\Test\GroupSeeder;
use Database\Seeders\Test\RoomSeeder;
use Database\Seeders\Test\SubjectSeeder;
use Database\Seeders\Test\TimetableSeeder;
use Database\Seeders\Test\UserSeeder;
use Illuminate\Database\Seeder;

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
            RoomSeeder::class,
            UserSeeder::class,
            CategoryAndTagSeeder::class,
            SubjectSeeder::class,
            GroupSeeder::class,
            TimetableSeeder::class,
        ]);
    }
}
