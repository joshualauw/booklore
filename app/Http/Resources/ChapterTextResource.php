<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterTextResource extends JsonResource
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
            "views" => $this->votes()->where('isView', true)->count(),
            "votes" => $this->votes()->where('isVote', true)->count(),
            "text" => $this->text,
            "isPublic" => $this->isPublic
        ];
    }
}
