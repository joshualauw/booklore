<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'text' => 'Fantasy'
        ]);
        Tag::create([
            'text' => 'Romance'
        ]);
        Tag::create([
            'text' => 'Thriller'
        ]);
        Tag::create([
            'text' => 'Horror'
        ]);
        Tag::create([
            'text' => 'Comedy'
        ]);
        Tag::create([
            'text' => 'Action'
        ]);
        Tag::create([
            'text' => 'Mystery'
        ]);
        Tag::create([
            'text' => 'Adventure'
        ]);
    }
}
