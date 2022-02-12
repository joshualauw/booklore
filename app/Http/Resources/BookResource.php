<?php

namespace App\Http\Resources;

use App\Models\Chapter;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "author" => $this->user,
            "description" => $this->description,
            "image" => $this->image,
            "chapterLastUpdate" => Chapter::orderBy("created_at", "desc")->pluck("created_at")->first()->diffForHumans(),
            "firstChapter" => $this->chapters()->where("isPublic", true)->orderBy('created_at', "asc")->pluck("id")->first(),
            "chapters" => $this->chapters()->where("isPublic", true)->count(),
            "views" => collect($this->chapters)->map(function ($chapter) {
                return $chapter->votes()->where("isView", 1)->count();
            })->sum(),
            "votes" => collect($this->chapters)->map(function ($chapter) {
                return $chapter->votes()->where("isVote", 1)->count();
            })->sum(),
            "tags" => $this->tags()->pluck("text"),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }

    //[a, b, c]
    //[2, 4, 6]
}
