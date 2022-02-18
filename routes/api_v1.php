<?php

use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ImageController;
use App\Http\Controllers\Api\V1\MechanicController;
use App\Http\Controllers\Api\V1\UserController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return response()->json([
        'data' => [
            'user' => 'user'
        ]
    ]);
});

Route::get('/posts/statics', [PostController::class, 'index']);

Route::get('/posts/images', [ImageController::class, 'postsImages']);

Route::apiResources([
    'images' => ImageController::class,
    'users' => UserController::class,
    'posts' => PostController::class,
    'mechanics' => MechanicController::class,
    'cars' => CarController::class
]);
