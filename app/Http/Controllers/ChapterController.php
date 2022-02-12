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
        if ($request->queryAll) {
            $chaptersByBookId = ChapterResource::collection($book->chapters()->get());
        } else {
            $chaptersByBookId = ChapterResource::collection($book->chapters()->where("isPublic", true)->get());
        }
        return response($chaptersByBookId);
    }

    public function show(Request $request, $id)
    {
        $chapter = Chapter::find($id);
        return response($chapter);
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::find($id);
        $chapter->title = $request->title;
        $chapter->text = $request->text;
        $chapter->save();
    }

    public function create(Request $request)
    {
        $newChapter = Chapter::create([
            "book_id" => $request->book_id,
            "title" => "",
            "text" => ""
        ]);
        return response($newChapter->id);
    }

    public function publish(Request $request, $id)
    {
        $chapter = Chapter::find($id);
        if ($chapter->isPublic) {
            $chapter->isPublic = false;
        } else {
            $chapter->isPublic = true;
        }
        $chapter->save();
        return response(
            [
                "data" => $chapter->isPublic,
                "message" => $chapter->isPublic ? 'published' : 'unpublished'
            ]
        );
    }
}
