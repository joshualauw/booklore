<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BookTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookTag::factory()->count(50)->state(new Sequence(
            function () {
                return [
                    "book_id" => Book::all()->random(),
                    "tag_id" => Tag::all()->random()
                ];
            }
        ))->create();
    }
}
