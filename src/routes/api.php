<?php

use App\Http\Controllers\AboutController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryAndTagController;

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

        //Info
        Route::put('/info', [InfoController::class, 'update']);
    }
);
