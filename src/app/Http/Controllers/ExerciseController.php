<?php

namespace App\Http\Controllers;

use App\Contracts\StoragePath;
use App\Http\Requests\Exercise\StoreExerciseRequest;
use App\Http\Requests\Exercise\SubmitExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Http\Resources\ExerciseCollection;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Services\ExerciseService;

class ExerciseController extends Controller
{

    private $exerciseService;

    public function __construct(ExerciseService $exerciseService)
    {
        $this->exerciseService = $exerciseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function listByStudent($studentID)
    {
        $exercises = Exercise::where('student_id', $studentID)->get();
        if (!$exercises) {
            return $this->notFoundResponse('Exercises not found');
        }
        return $this->successResponse(
            new ExerciseCollection($exercises),
            'Exercises retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExerciseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExerciseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function submit(SubmitExerciseRequest $request, $id)
    {
        $exercise = Exercise::find($id);
        if (!$exercise) {
            return $this->notFoundResponse('Exercise not found');
        }
        $validated = $request->validated();
        if (isset($validated['file'])) {
            $validated['file'] = $this->exerciseService->processFile(
                $validated['file'],
                StoragePath::EXERCISE_FILE,
            );

        }
        $exercise->fill($validated);
        $exercise->is_submit = true;
        $exercise->save();
        return $this->successResponse(
            new ExerciseResource($exercise),
            'Exercise updated successfully'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExerciseRequest  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        //
    }
}
