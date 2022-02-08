<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => "Joshualauw",
            'email' => 'joshualauw1@gmail.com',
            'password' => bcrypt("123456"),
            "phone" => "082132621654",
        ]);

        User::create([
            'username' => "nathanlauw",
            'email' => 'nathanlauw1@gmail.com',
            'password' => bcrypt("123456"),
            "phone" => "082132621654",
        ]);
    }
}
