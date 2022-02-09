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
            "profile" => "https://img.wattpad.com/useravatar/Lawenvy.128.304834.jpg",
            'password' => bcrypt("123456"),
            "phone" => "082132621654",
        ]);

        User::create([
            'username' => "nathanael",
            'email' => 'nathanlauw1@gmail.com',
            "profile" => "https://i.pinimg.com/474x/d5/e2/c5/d5e2c5c0315e6b1f3cc30189f9dccd82.jpg",
            'password' => bcrypt("123456"),
            "phone" => "086183948170",
        ]);

        User::create([
            'username' => "alexdaud",
            'email' => 'alexlauw1@gmail.com',
            "profile" => "https://wpage.in/wp-content/uploads/2021/08/1629638112_294_38-Sports-car-free-images-hd-download-for-Whatsapp-DP.jpg",
            'password' => bcrypt("123456"),
            "phone" => "081198561772",
        ]);
    }
}
