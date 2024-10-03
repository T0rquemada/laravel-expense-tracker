<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void {
        $response = $this->get('/sign-in-view');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void {
        $response = $this->post('/sign-in', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_invalidate_empty_body(): void {
        $response = $this->post('/sign-in', []);
        $response->assertStatus(422);
    }
}
