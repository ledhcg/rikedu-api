<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Default\CategoryAndTagSeeder;
use Database\Seeders\Default\ExamSeeder;
use Database\Seeders\Default\GroupSeeder;
use Database\Seeders\Default\InfoSeeder;
use Database\Seeders\Default\ResultSeeder;
use Database\Seeders\Default\RoleAndPermissionSeeder;
use Database\Seeders\Default\RoomSeeder;
use Database\Seeders\Default\SubjectSeeder;
use Database\Seeders\Default\TimetableSeeder;
use Database\Seeders\Default\UserSeeder;
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
            //New
            RoomSeeder::class,
            UserSeeder::class,
            CategoryAndTagSeeder::class,
            SubjectSeeder::class,
            GroupSeeder::class,
            TimetableSeeder::class,
            ResultSeeder::class,
            ExamSeeder::class,
        ]);
    }
}
