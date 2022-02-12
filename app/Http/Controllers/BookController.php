<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Book;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function latest()
    {
        $latestBooks = BookResource::collection(Book::latest()->whereHas("chapters", function (Builder $query) {
            $query->where('isPublic', true);
        })->limit(10)->get());
        return response($latestBooks);
    }

    public function byUser(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->queryAll) {
            $userWritings = BookResource::collection($user->books);
        } else {
            $userWritings = BookResource::collection($user->books()->whereHas("chapters", function (Builder $query) {
                $query->where('isPublic', true);
            })->get());
        }
        return response($userWritings);
    }

    public function byTag(Request $request)
    {
        $booksByTags = [];
        if (!$request->tags) {
            $booksByTags = BookResource::collection(Book::latest()->whereHas("chapters", function (Builder $query) {
                $query->where('isPublic', true);
            })->get());
        } else {
            $booksByTags = BookResource::collection(Book::whereHas("tags", function (Builder $query) use ($request) {
                $query->whereIn("text", $request->tags);
            })->whereHas("chapters", function (Builder $query) {
                $query->where('isPublic', true);
            })->get());
        }
        return response($booksByTags);
    }

    public function byTitle(Request $request)
    {
        $booksByTitle = [];
        $booksByTitle = BookResource::collection(Book::where("title", "like", "%$request->title%")->whereHas("chapters", function (Builder $query) {
            $query->where('isPublic', true);
        })->get());
        return response($booksByTitle);
    }

    public function highlyRated()
    {
        // $highlyRatedBooks = Book::join("votes", "books.id", "votes.book_id")->where("isVote", true)->select('*', DB::raw("count(isVote) as total_votes"))->groupBy("books.id", "books.user_id", "books.title", "books.description", "books.created_at", "books.updated_at", "books.image", "votes.id", "votes.book_id", 'votes.user_id', "votes.isView", "votes.isVote", "votes.created_at", "votes.updated_at")->orderBy("total_votes", "desc")->get();
        $highlyRatedBooks = BookResource::collection(Book::latest()->whereHas("chapters", function (Builder $query) {
            $query->where('isPublic', true);
        })->limit(10)->get());
        return response($highlyRatedBooks);
    }

    public function random()
    {
        $randomBook = new BookResource(Book::latest()->whereHas("chapters", function (Builder $query) {
            $query->where('isPublic', true);
        })->first());
        return response($randomBook);
    }

    public function show(Request $request, $id)
    {
        $book = new BookResource(Book::find($id));
        return response($book);
    }

    public function create(Request $request)
    {
        $request->validate([
            "title" => 'required',
            "description" => 'required',
            'tags' => 'array|required'
        ], [
            "title.required" => "Book Title is required",
            "description.required" => 'Book Description is required',
            "tags.required" => "Book must have at least one tag"
        ]);

        $newBook = Book::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        foreach ($request->tags as $tag) {
            $t = Tag::where("text", $tag)->first();
            $newBook->tags()->attach($t->id);
        }

        return response($newBook);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $request->validate([
            "title" => 'required',
            "description" => 'required',
            'tags' => 'array|required'
        ], [
            "title.required" => "Book Title is required",
            "description.required" => 'Book Description is required',
            "tags.required" => "Book must have at least one tag"
        ]);

        $book->update([
            "title" => $request->title,
            "description" => $request->description,
        ]);

        foreach (Tag::all() as $tag) {
            $book->tags()->detach($tag->id);
        }
        foreach ($request->tags as $tag) {
            $t = Tag::where("text", $tag)->first();
            $book->tags()->attach($t->id);
        }

        return response($book);
    }

    public function updateBookCover(Request $request, $id)
    {
        $newBook = Book::find($id);
        if ($request->file()) {
            $file_name = $newBook->id . "." . $request->file('image')->getClientOriginalExtension();
            $file_path = $request->file('image')->storeAs('covers', $file_name, 'public');
            $newBook->image = '/storage/' . $file_path;
            $newBook->save();
        }
    }
}
