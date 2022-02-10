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
            "chapters" => count($this->chapters()->where("isPublic", true)->pluck('id')),
            "drafts" => count($this->chapters()->where("isPublic", false)->pluck('id')),
            "views" => count($this->votes()->where('isView', 1)->get()),
            "votes" => count($this->votes()->where('isVote', 1)->get()),
            "tags" => $this->tags()->pluck("text"),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
