<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chapter::factory()->count(50)->state(new Sequence(
            function () {
                return [
                    "book_id" => Book::all()->random(),
                ];
            }
        ))->create();
    }
}
