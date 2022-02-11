<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vote::factory()->count(500)->state(new Sequence(
            function () {
                return [
                    "user_id" => User::all()->random(),
                    "chapter_id" => Chapter::all()->random()
                ];
            }
        ))->create();
    }
}
