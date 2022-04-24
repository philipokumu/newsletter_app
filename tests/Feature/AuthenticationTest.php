<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertStatus(200);

        $response->assertSeeText('token', $escaped = true);
    }
}
