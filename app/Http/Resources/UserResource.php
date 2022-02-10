<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "profile" => $this->profile,
            "background" => $this->background,
            "phone" => $this->phone,
            "library" => $this->libraries()->pluck("books.id"),
            "writings" => $this->books()->where("isPublic", true)->pluck("books.id"),
            "draft" => $this->books()->where("isPublic", false)->pluck("books.id"),
            "followers" => $this->followers()->select("users.id as id", "username", "profile")->get(),
            "followings" => $this->followings()->select("users.id as id", "username", "profile")->get(),
            "notifications" => $this->unreadNotifications,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
