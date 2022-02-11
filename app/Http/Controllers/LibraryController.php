<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Library;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\Builder;

class LibraryController extends Controller
{
    public function store(Request $request)
    {
        Library::create([
            "book_id" => $request->book_id,
            "user_id" => $request->user_id
        ]);
        return response($request->book_id);
    }

    public function delete(Request $request)
    {
        $library = Library::where([
            ["book_id", $request->book_id],
            ["user_id", $request->user_id]
        ])->first();
        $library->delete();
        return response($request->book_id);
    }

    public function byUser(Request $request, $id)
    {
        $user = User::find($id);
        $userLibrary = BookResource::collection($user->libraries()->whereHas("chapters", function (Builder $query) {
            $query->where('isPublic', true);
        })->get());
        return response($userLibrary);
    }
}
