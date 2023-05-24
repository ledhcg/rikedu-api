<?php

namespace Database\Seeders\Default;

use App\Models\Role;
use App\Models\Room;
use App\Models\Subject;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $subjects = [
            [
                "name" => "Русский язык",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Литература",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Математика",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Физика",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Химия",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Биология",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Информатика",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Иностранный язык",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "История",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Обществознание",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "География",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Физическая культура",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "X",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 10,
            ],
            [
                "name" => "Русский язык",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Литература",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Математика",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Физика",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Химия",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Биология",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Информатика",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Иностранный язык",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "История",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Обществознание",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "География",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "Физическая культура",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
            [
                "name" => "X",
                "teacher_quantity" => 6,
                "room_quantity" => 6,
                "week_lessons" => 6,
                "grade" => 11,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::factory()->create([
                "name" => $subject['name'],
                "grade" => $subject['grade'],
                "teacher_quantity" => $subject['teacher_quantity'],
                "room_quantity" => $subject['room_quantity'],
                "week_lessons" => $subject['week_lessons'],
                "description" => $faker->sentence(),
            ]);
        }

        $list_subjects = Subject::all();

        $role_teacher = Role::findByName('teacher');
        $list_teachers = $role_teacher->users()->get()->shuffle();

        $list_rooms = Room::all()->shuffle();

        $count_teachers = 0;
        $count_rooms = 0;

        foreach ($list_subjects as $subject) {
            for ($i = 1; $i <= $subject->teacher_quantity; $i++) {
                $subject->teachers()->attach($list_teachers[$count_teachers]);
                $count_teachers++;
            }
            for ($i = 1; $i <= $subject->room_quantity; $i++) {
                $subject->rooms()->attach($list_rooms[$count_rooms]);
                $count_rooms++;
            }
        }
    }
}
