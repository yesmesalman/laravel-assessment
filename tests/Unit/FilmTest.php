<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Film;

class FilmTest extends TestCase
{
    /**
     * Test film detail screen status.
     *
     * @return void
     */
    public function testRequiredStatus()
    {
        $film = Film::find(1)->first();
        $this->get('/films/' . $film->slug)->assertStatus(200);
    }

    /**
     * Test film detail screen name.
     *
     * @return void
     */
    public function testRequiredName()
    {
        $film = Film::find(1)->first();
        $this->get('/films/' . $film->slug)->assertSeeText($film->name);
    }

    /**
     * Test film detail screen description.
     *
     * @return void
     */
    public function testRequiredDescription()
    {
        $film = Film::find(1)->first();
        $this->get('/films/' . $film->slug)->assertSeeText($film->description);
    }

    /**
     * Test film detail screen comments.
     *
     * @return void
     */
    public function testRequiredComments()
    {
        $film = Film::find(1)->first();

        $user = \App\Models\User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel')
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/films');
        
        foreach ($film->comments as $c) {
            $this->assertAuthenticatedAs($user)->get('/films/' . $film->slug)->assertSeeText($film->name);
        }
    }
}
