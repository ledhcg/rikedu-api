<?php

namespace Database\Seeders\Default;

use App\Models\Exam;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
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
            $subjects = Subject::all();
            foreach ($subjects as $subject) {
                foreach ($group->students as $student) {
                    Exam::factory()->create([
                        "group_id" => $group->id,
                        "student_id" => $student->id,
                        "subject_id" => $subject->id,
                        "title" => "Тест №1",
                        "description" => "Цель: проверить знания с первой недели по пятую неделю.",
                        "mark" => 4,
                        "review" => "Хорошо",
                    ]);

                    Exam::factory()->create([
                        "group_id" => $group->id,
                        "student_id" => $student->id,
                        "subject_id" => $subject->id,
                        "title" => "Тест №2",
                        "description" => "Цель: проверить знания с шестой недели по десятую неделю.",
                        "mark" => 5,
                        "review" => "Отлично",
                    ]);

                    Exam::factory()->create([
                        "group_id" => $group->id,
                        "student_id" => $student->id,
                        "subject_id" => $subject->id,
                        "title" => "Тест №3",
                        "description" => "Цель: проверить знания с одиннадцатой недели по пятнадцатую неделю.",
                        "mark" => 5,
                        "review" => "Отлично",
                    ]);

                    Exam::factory()->create([
                        "group_id" => $group->id,
                        "student_id" => $student->id,
                        "subject_id" => $subject->id,
                        "title" => "Экзамен",
                        "description" => "Цель: проверить всю основную теорию предмета.",
                        "mark" => 5,
                        "review" => "Отлично",
                    ]);
                }
            }
        }
    }
}
