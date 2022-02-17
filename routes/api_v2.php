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
