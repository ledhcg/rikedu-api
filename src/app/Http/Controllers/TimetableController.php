<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimetableRequest;
use App\Http\Requests\UpdateTimetableRequest;
use App\Http\Resources\TimetableCollection;
use App\Models\Group;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    const DAYS = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    const LESSONS = 7;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $timetables = Timetable::paginate($perPage);

        return $this->successResponse(
            new TimetableCollection($timetables),
            'Timetables retrieved successfully'
        );
    }
    public function generate()
    {
        Timetable::truncate();

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
            Timetable::create([
                "group_id" => $group->id,
                "data" => json_encode($timetable),
            ]);
        }
        return $this->successResponse(
            true,
            'Timetables generated successfully'
        );
    }

    public function create()
    {
        //
    }

    public function store(StoreTimetableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTimetableRequest  $request
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimetableRequest $request, Timetable $timetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
}