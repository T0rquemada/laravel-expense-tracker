<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase {
    use RefreshDatabase;

    public function test_create_expense_note(): void {
        $user = User::factory()->create(); // Create user

        $response = $this->post('/create_note', [
                'user_id' => $user->id,
                'amount' => 100,
                'category' => 'food',
                'type' => 'expenses'
        ]);

        $response->assertStatus(200);
    }

    public function test_create_income_note(): void {
        $user = User::factory()->create(); // Create user

        $response = $this->post('/create_note', [
                'user_id' => $user->id,
                'amount' => 1000,
                'category' => 'salary',
                'type' => 'incomes'
        ]);

        $response->assertStatus(200);
    }

    public function test_handle_empty_data(): void {
        $response = $this->post('/create_note', []);
        $response->assertStatus(422);
    }

}
