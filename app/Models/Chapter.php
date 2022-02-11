<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function votes()
    {
        return $this->belongsToMany(User::class, 'votes');
    }
}
