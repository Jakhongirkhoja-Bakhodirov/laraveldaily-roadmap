<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\MyController;

Route::get('/', function (Request $request) {
    return response()->json([
        'data' => [
            'user' => 'user',
            'path' => $request->path()
        ]
    ]);
});

Route::get('/user', [MyController::class, 'index']);


Route::middleware('throttle:4,1')->group(function () {
    Route::get('/rate-limiting', function () {
        return response()->json([
            'data' => [
                'rate-limit' => '4'
            ]
        ], 200);
    });
});


Route::domain('{account}.myapp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        return response()->json([
            'data' => [
                'route-domain' => 'set domain api'
            ]
        ], 200);
    });
});
