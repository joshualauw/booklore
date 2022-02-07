<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BookResource;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function latest()
    {
        $latestBooks = BookResource::collection(Book::latest()->limit(10)->get());
        return response($latestBooks);
    }

    public function byTag(Request $request)
    {
        $bookByTags = [];
        if (!$request->tags) {
            $bookByTags = BookResource::collection(Book::latest()->get());
        } else {
            $bookByTags = BookResource::collection(Book::whereHas("tags", function (Builder $query) use ($request) {
                $query->whereIn("text", $request->tags);
            })->get());
        }
        return response($bookByTags);
    }

    public function highlyRated()
    {
        // $highlyRatedBooks = Book::join("votes", "books.id", "votes.book_id")->where("isVote", true)->select('*', DB::raw("count(isVote) as total_votes"))->groupBy("books.id", "books.user_id", "books.title", "books.description", "books.created_at", "books.updated_at", "books.image", "votes.id", "votes.book_id", 'votes.user_id', "votes.isView", "votes.isVote", "votes.created_at", "votes.updated_at")->orderBy("total_votes", "desc")->get();
        $highlyRatedBooks = BookResource::collection(Book::latest()->limit(10)->get());
        return response($highlyRatedBooks);
    }

    public function random()
    {
        $randomBook = new BookResource(Book::all()->random());
        return response($randomBook);
    }

    public function show(Request $request, $id)
    {
        $book = new BookResource(Book::find($id));
        return response($book);
    }
}
