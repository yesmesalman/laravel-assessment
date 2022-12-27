<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::insert([[
            'film_id' => 1,
            'genre' => 'Action',
        ], [
            'film_id' => 2,
            'genre' => 'Horror',
        ], [
            'film_id' => 3,
            'genre' => 'Drama',
        ]]);
    }
}
