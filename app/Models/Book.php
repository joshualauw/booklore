<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function libraries()
    {
        return $this->belongsToMany(User::class, "libraries");
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "book_tags");
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function reviews()
    {
        return $this->belongsToMany(User::class, "reviews");
    }

    public function votes()
    {
        return $this->belongsToMany(User::class, "votes");
    }
}
