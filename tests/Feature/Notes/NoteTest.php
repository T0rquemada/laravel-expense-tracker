<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase {
    use RefreshDatabase;

    public function test_create_expense_note(): void {
        $user = User::factory()->create(); 
        $category = Category::factory()->create(['user_id' => $user->id]); 

        $response = $this->withoutMiddleware()->post('/create_note', [
                'user_id' => $user->id,
                'amount' => 100,
                'category_id' => $category->id,
                'type' => 'expenses'
        ]);

        $response->assertStatus(200);
    }

    public function test_create_income_note(): void {
        $user = User::factory()->create(); 
        $category = Category::factory()->create(['user_id' => $user->id]); 

        $response = $this->withoutMiddleware()->post('/create_note', [
                'user_id' => $user->id,
                'amount' => 1000,
                'category_id' => $category->id,
                'type' => 'incomes'
        ]);

        $response->assertStatus(200);
    }

    public function test_handle_empty_data(): void {
        $response = $this->withoutMiddleware()->post('/create_note', []);
        $response->assertStatus(422);
    }

}
