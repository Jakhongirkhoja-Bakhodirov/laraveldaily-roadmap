<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function index()
    {
        return response()->json(
            ['data' => [
                'user' => 'user from api/v1',
                'api_version' => config('app.api_latest')
            ]],
            200
        );
    }
}
