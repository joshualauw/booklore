<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Library;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Library::factory()->count(20)->state(new Sequence(
            function () {
                return [
                    "user_id" => User::all()->random(),
                    "book_id" => Book::all()->random()
                ];
            }
        ))->create();
    }
}
