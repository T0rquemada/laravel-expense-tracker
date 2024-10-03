<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        $users = User::factory()->count(10)->create();

        for ($i = 0; $i < 50; $i++) { 
            Category::create([
                'title' => $faker->unique()->word(),
                'user_id' => $users->random()->id, // Randomly assign a user_id
            ]);
        }
    }
}