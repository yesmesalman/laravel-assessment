<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Film;

class AuthTest extends TestCase
{
    /**
     * Unit test for Auth login.
     *
     * @return void
     */
    public function testAuthenticated()
    {
        $user = \App\Models\User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel')
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/films');
        $this->assertAuthenticatedAs($user);
    }
}
