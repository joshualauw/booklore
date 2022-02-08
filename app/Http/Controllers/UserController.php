<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = new UserResource(User::find($id));
        return response($user);
    }
}
