<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\PodcastProcessed;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'data' => [
                'users' => $users
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'data' => [
                'user' => 'user'
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        event(new PodcastProcessed($user));

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Users $user;
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->mergeCasts([
            'is_admin' => 'integer'
        ]);
        $user->is_admin = 12;
        $user->name_upper = 'sas';
        return response()->json([
            'data' => [
                'user' => $user,
                'name_upper' => $user->name_upper,
                'name-email' => $user->name_email,
                'user-images' => $user->image,
                'user-posts' => $user->posts,
                'latest-post' => $user->latestPost,
                'oldest-post' => $user->oldestPost,
                'current-post' => $user->currentPost
            ]
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
