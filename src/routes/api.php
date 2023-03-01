<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;


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
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{id}', [PostController::class, 'show']);
        Route::post('/posts', [PostController::class, 'store']);
        Route::put('/posts/{id}', [PostController::class, 'update']);
        Route::delete('/posts/{id}', [PostController::class, 'destroy']);

        //User
        Route::get('/users', [UserController::class, 'index']);
    }
);