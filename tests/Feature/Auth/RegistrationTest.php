<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void {
        $response = $this->get('/sign-up-view');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void {
        $response = $this->post('/sign-up', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_invalidate_empty_body(): void {
        $response = $this->post('/sign-up', []);
        $response->assertStatus(422);
    }
}
