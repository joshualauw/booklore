<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function byBook(Request $request, $id)
    {
        $book = Book::find($id);
        $chaptersByBookId = $book->chapters()->select("id", "title")->get();
        return response($chaptersByBookId);
    }
}
