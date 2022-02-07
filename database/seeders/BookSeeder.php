<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()
            ->count(20)
            ->state(new Sequence(
                function () {
                    return [
                        "user_id" => User::all()->random(),
                    ];
                }
            ))->create();
    }
}
