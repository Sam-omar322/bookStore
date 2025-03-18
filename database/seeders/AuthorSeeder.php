<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Author::create([
                'name' => fake()->name(),
                'image' => 'author' . $i . '.jpg',
                'description' => fake()->paragraph(),
            ]);
        }
    }
}
