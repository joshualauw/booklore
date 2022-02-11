<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            BookSeeder::class,
            ChapterSeeder::class,
            VoteSeeder::class,
            BookTagSeeder::class,
            LibrarySeeder::class
        ]);
    }
}
