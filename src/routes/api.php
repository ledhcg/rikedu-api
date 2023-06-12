<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryAndTagController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RandomController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', function () {
    return new JsonResponse(
        [
            'success' => true,
            'status_code' => Response::HTTP_OK,
            'message' => 'Hello o.o',
        ],
        Response::HTTP_OK
    );
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    //Info
    Route::get('/info', [InfoController::class, 'index']);

    //About
    Route::get('/abouts', [AboutController::class, 'index']);
    Route::get('/abouts/{id}', [AboutController::class, 'show']);

    //User
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/{id}/update-avatar', [UserController::class, 'updateAvatar']);
    Route::put('/users/{id}/edit-profile', [UserController::class, 'editProfile']);
    Route::get('/users/super-admin', [UserController::class, 'superAdmin']);
    Route::get('/users/teachers', [UserController::class, 'teachers']);
    Route::get('/users/parents', [UserController::class, 'parents']);
    Route::get('/users/students', [UserController::class, 'students']);

    //Subject
    Route::get('/subjects', [SubjectController::class, 'index']);

    //Group
    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/groups/{groupId}', [GroupController::class, 'show']);

    //Result
    Route::get('/results', [ResultController::class, 'index']);
    Route::get('/results/{studentId}', [ResultController::class, 'listByStudent']);

    //Exam
    Route::get('/exams', [ExamController::class, 'index']);
    Route::get('/exams/{studentId}', [ExamController::class, 'listByStudent']);

    //Timetable
    Route::get('/timetables', [TimetableController::class, 'index']);
    Route::get('/timetables/{groupId}', [TimetableController::class, 'show']);
    Route::get('/timetables/generate', [TimetableController::class, 'generate']);

    //Notification
    Route::resource('notifications', NotificationController::class);
    Route::get('notifications/user/{userID}', [NotificationController::class, 'listByUserID']);
    Route::put('notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);

    //Exercise
    Route::get('exercises/user/{userID}', [ExerciseController::class, 'listByStudent']);
    Route::put('exercises/{id}/submit', [ExerciseController::class, 'submit']);
    Route::put('exercises/{id}/mark', [ExerciseController::class, 'mark']);

    //Random
    Route::get('random/quote', [RandomController::class, 'quote']);
    Route::get('random/image', [RandomController::class, 'image']);

    //Post
    Route::get('/posts', [PostController::class, 'list']);
    Route::get('/{group}&slug={slug}/posts', [
        PostController::class,
        'listGroup',
    ]);
    Route::get('/posts/{id}', [PostController::class, 'show']);

    //Category
    Route::get('/categories', [
        CategoryAndTagController::class,
        'listCategories',
    ]);

    //Tag
    Route::get('/tags', [CategoryAndTagController::class, 'listTags']);
});

Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers',
        'middleware' => ['auth:sanctum'],
    ],
    function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        //Post
        Route::post('/posts', [PostController::class, 'store']);
        Route::put('/posts/{id}', [PostController::class, 'update']);
        Route::delete('/posts/{id}', [PostController::class, 'destroy']);

        //About
        Route::post('/abouts', [AboutController::class, 'store']);
        Route::put('/abouts/{id}', [AboutController::class, 'update']);
        Route::delete('/abouts/{id}', [AboutController::class, 'destroy']);

        //Category
        Route::post('/categories', [
            CategoryAndTagController::class,
            'storeCategory',
        ]);
        Route::put('/categories/{id}', [
            CategoryAndTagController::class,
            'updateCategory',
        ]);
        Route::delete('/categories/{id}', [
            CategoryAndTagController::class,
            'destroyCategory',
        ]);

        //Info
        Route::put('/info', [InfoController::class, 'update']);
    }
);
