<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $recentPosts = Post::postedWithin14Days()
            ->latest()
            ->take(5)
            ->get();

        $popularPosts = Post::postedWithin14Days()
            ->orderBy('view_counts', 'desc')
            ->take('5')
            ->get();

        return response()->json([
            'data' => [
                'recent-posts' => $recentPosts,
                'popular-posts' => $popularPosts
            ]
        ], 200);
    }
}
