<?php

namespace Database\Seeders\Default;

use App\Models\Group;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::all();
        foreach ($groups as $group) {
            $subjects = Subject::where('grade', $group->grade)->get();
            foreach ($subjects as $subject) {
                foreach ($group->students as $student) {
                    Result::factory()->create([
                        "group_id" => $group->id,
                        "student_id" => $student->id,
                        "subject_id" => $subject->id,
                        "exam_1" => 4,
                        "exam_2" => 5,
                        "exam_3" => 5,
                        "active" => 22,
                        "final_exam" => 5,
                        "review" => "Отлично",
                    ]);
                }
            }
        }
    }
}
