<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'description' => $this->faker->words(10, true),
            'release_date' => $this->faker->date('Y-m-d H:i:s'),
            'rating' => 2,
            'ticket_price' => $this->faker->randomNumber(2),
            'photo' => "assets/banners/1672088766.jpg"
        ];
    }
}
