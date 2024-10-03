<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) { 
            Category::create([
                'title' => $faker->unique()->word(),
            ]);
        }
    }
}