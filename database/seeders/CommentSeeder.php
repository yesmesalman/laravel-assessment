<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::insert([[
            'user_id' => 1,
            'name' => 'Andy Dufresne',
            'comment' => 'The man who cried and was beaten when Andy first arrived is listed',
            'film_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], [
            'user_id' => 1,
            'name' => 'Sleeping Dragon',
            'comment' => 'The ultimate story of friendship',
            'film_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], [
            'user_id' => 1,
            'name' => 'Morgan Freeman',
            'comment' => 'It is no wonder that the film has such a high rating',
            'film_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]);
    }
}
