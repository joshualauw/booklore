<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            "description" => $this->faker->text(400),
            "image" => "https://edit.org/images/cat/book-covers-big-2019101610.jpg",
        ];
    }
}
