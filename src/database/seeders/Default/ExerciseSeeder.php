<?php

namespace Database\Seeders\Default;

use App\Models\Exercise;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = [
            [
                "topic" => "Introduction to English",
                "note" => "Review the alphabet and basic greetings.",
                "deadline" => "2023-06-01",
            ],
            [
                "topic" => "Family",
                "note" => "Write a short paragraph describing your family members.",
                "deadline" => "2023-06-05",
            ],
            [
                "topic" => "Food and Drinks",
                "note" => "Create a menu for a traditional Russian meal in English.",
                "deadline" => "2023-06-10",
            ],
            [
                "topic" => "Daily Routine",
                "note" => "Write a diary entry in English about your typical day.",
                "deadline" => "2023-06-15",
            ],
            [
                "topic" => "Hobbies",
                "note" => "Prepare a presentation about your favorite hobby and present it in class.",
                "deadline" => "2023-06-20",
            ],
            [
                "topic" => "Travel",
                "note" => "Design a travel brochure for a city or country of your choice in English.",
                "deadline" => "2023-06-25",
            ],
            [
                "topic" => "Health and Fitness",
                "note" => "Write an essay discussing the importance of a healthy lifestyle.",
                "deadline" => "2023-06-30",
            ],
            [
                "topic" => "Technology",
                "note" => "Prepare a short speech about the impact of technology on society.",
                "deadline" => "2023-07-05",
            ],
            [
                "topic" => "Environment",
                "note" => "Research and present a project on environmental issues in English.",
                "deadline" => "2023-07-10",
            ],
            [
                "topic" => "Future Plans",
                "note" => "Write a letter to your future self, describing your goals and aspirations.",
                "deadline" => "2023-07-15",
            ],
        ];

        $groups = Group::all();
        foreach ($groups as $group) {
            $subjects = Subject::where('grade', $group->grade)->get();
            foreach ($subjects as $subject) {
                if ($subject->name == 'Иностранный язык') {
                    foreach ($group->students as $student) {
                        foreach ($exercises as $exercise) {
                            Exercise::factory()->create([
                                "group_id" => $group->id,
                                "student_id" => $student->id,
                                "subject_id" => $subject->id,
                                "topic" => $exercise['topic'],
                                "note" => $exercise['note'],
                                "deadline" => $exercise['deadline'],
                            ]);
                        }

                    }
                }
            }
        }
    }
}
