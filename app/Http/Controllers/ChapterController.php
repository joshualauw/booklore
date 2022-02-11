<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChapterResource;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function byBook(Request $request, $id)
    {
        $book = Book::find($id);
        $chaptersByBookId = ChapterResource::collection($book->chapters()->get());
        return response($chaptersByBookId);
    }

    public function show(Request $request, $id)
    {
        $chapter = Chapter::find($id);
        return response($chapter);
    }
}
