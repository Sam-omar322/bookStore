<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'description' => fake()->sentence(),
            ]);
        }
    }
}
