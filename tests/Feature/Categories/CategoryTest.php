<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase {
    use RefreshDatabase;

    public function test_create_category(): void {
        $user = User::factory()->create(); // Create user

        $response = $this->withoutMiddleware()->post('/create_category', [
            'title' => 'food',
            'user_id' => $user->id
        ]);

        $response->assertStatus(200);
    }

    public function test_handle_empty_data(): void {
        $response = $this->withoutMiddleware()->post('/create_category', []);
        $response->assertStatus(422);
    }

}
