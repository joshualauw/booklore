<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        Follow::create([
            "user_id" => $request->followed_id,
            "follower_id" => $request->user_id
        ]);
    }

    public function unfollow(Request $request)
    {
        $followed = Follow::where([
            "user_id" => $request->followed_id,
            "follower_id" => $request->user_id
        ])->first();
        $followed->delete();
    }
}
