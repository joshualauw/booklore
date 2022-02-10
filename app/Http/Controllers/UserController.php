<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Notifications\NewFollowNotification;
use Illuminate\Notifications\Notification;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = new UserResource(User::find($id));
        return response($user);
    }

    public function newFollowerNotify(Request $request)
    {
        $user = User::find($request->user_id);
        $user->notify(new NewFollowNotification($request->follower_username));
    }

    public function readFollowerNotify(Request $request)
    {
        $user = User::find($request->user_id);
        $user->unreadNotifications->markAsRead();
    }

    public function getNewFollowerNotification(Request $request)
    {
        $user = User::find($request->user_id);
        return response($user->unreadNotifications);
    }
}
