<?php

namespace Database\Seeders\Default;

use App\Models\Group;
use App\Models\Role;
use App\Models\Subject;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $groups = [
            [
                "name" => "А",
                "grade" => 10,
                "time" => "2022-2023",
            ],
            [
                "name" => "Б",
                "grade" => 10,
                "time" => "2022-2023",
            ],
            [
                "name" => "В",
                "grade" => 10,
                "time" => "2022-2023",
            ],
            [
                "name" => "А",
                "grade" => 11,
                "time" => "2022-2023",
            ],
            [
                "name" => "Б",
                "grade" => 11,
                "time" => "2022-2023",
            ],
            [
                "name" => "В",
                "grade" => 11,
                "time" => "2022-2023",
            ],
        ];

        foreach ($groups as $group) {
            Group::factory()->create([
                "name" => $group['name'],
                "grade" => $group['grade'],
                "time" => $group['time'],
                "description" => $faker->sentence(),
            ]);
        }

        // Create group of students
        $role_teacher = Role::findByName('teacher');
        $role_student = Role::findByName('student');
        $list_teachers = $role_teacher->users()->get()->shuffle();
        $list_students = $role_student->users()->get()->shuffle();

        $student_quantity = 20;

        $list_groups = Group::all();
        $count = 0;
        foreach ($list_groups as $group) {
            for ($i = 1; $i <= $student_quantity; $i++) {
                $group->students()->attach($list_students[$count]);
                $count++;
            }
        }

        // Create group of students
        $list_subjects_10 = Subject::where('grade', 10)->get();
        $list_subjects_11 = Subject::where('grade', 10)->get();
        $list_groups_10 = Group::where('grade', 10)->get()->shuffle();
        $list_groups_11 = Group::where('grade', 11)->get()->shuffle();

        foreach ($list_groups_10 as $index => $group) {
            foreach ($list_subjects_10 as $subject) {
                $group->teachers()->attach($subject->teachers[$index]);
                $group->rooms()->attach($subject->rooms[$index]);
            }
        }

        foreach ($list_groups_11 as $index => $group) {
            foreach ($list_subjects_11 as $subject) {
                $group->teachers()->attach($subject->teachers[$index]);
                $group->rooms()->attach($subject->rooms[$index]);
            }
        }
    }
}
