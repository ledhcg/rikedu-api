<?php

namespace Database\Seeders\Test;

use App\Models\Group;
use App\Models\Timetable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TimetableSeeder extends Seeder
{
    const DAYS = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    const WEEKEND = ["Saturday", "Sunday"];
    const LESSONS = 7;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::all();

        foreach ($groups as $group) {
            $list_lesson_by_teacher_id = [];
            $timetable = [];
            $teachers_of_group = $group->teachers;
            $rooms_of_group = $group->rooms;
            foreach ($teachers_of_group as $index => $teacher) {
                for ($i = 1; $i <= intval($teacher->subjects->pluck('week_lessons')[0]); $i++) {
                    array_push($list_lesson_by_teacher_id,
                        [
                            "teacher_id" => $teacher->id,
                            "room_id" => $rooms_of_group[$index]->id,
                        ]
                    );
                }
            }
            shuffle($list_lesson_by_teacher_id);
            $count_lessons = 0;
            foreach (self::DAYS as $day) {
                $lesson_on_day = [];
                for ($i = 1; $i <= self::LESSONS; $i++) {
                    array_push($lesson_on_day,
                        $list_lesson_by_teacher_id[$count_lessons]
                    );
                    $count_lessons++;
                }
                $timetable[$day] = $lesson_on_day;
            }

            foreach (self::WEEKEND as $day) {
                $timetable[$day] = [];
            }

            Log::info(json_encode($timetable));
            Timetable::factory()->create([
                "group_id" => $group->id,
                "data" => json_encode(array_values($timetable)),
            ]);
        }
    }
}
