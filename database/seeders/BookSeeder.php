<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // 👉 Fetch all category IDs from the database and store them as an array
         $categoryIds = Category::pluck('id')->toArray();

         // 👉 Fetch all publisher IDs from the database and store them as an array
         $publisherIds = Publisher::pluck('id')->toArray();
 
         // 👉 Fetch all author IDs from the database and store them as an array
         $authorIds = Author::pluck('id')->toArray();
 
         // 👉 Loop to create 20 sample books
         for ($i = 1; $i <= 6; $i++) {
 
             // 👉 Create a new book record with fake data
             $book = Book::create([
                 'title' => fake()->sentence(3),                       // Random 3-word book title
                 'isbn' => fake()->isbn13(),                          // Random ISBN number
                 'description' => fake()->paragraph(),                // Random book description
                 'publish_year' => fake()->year(),                    // Random publish year
                 'number_of_pages' => fake()->numberBetween(100, 500),// Random page count between 100-500
                 'number_of_copies' => fake()->numberBetween(1, 50),  // Random number of available copies
                 'price' => fake()->randomFloat(2, 10, 100),          // Random price between 10-100
                 'cover_image' => 'images/covers/' . $i . '.png',              // Dummy cover image filename
                 'category_id' => fake()->randomElement($categoryIds),// Random category assigned
                 'publish_id' => fake()->randomElement($publisherIds),// Random publisher assigned
             ]);
 
             // 👉 Attach 1 to 3 random authors (many-to-many relation)
             $randomAuthorIds = fake()->randomElements($authorIds, rand(1, 3));
             $book->authors()->attach($randomAuthorIds);
         }
    }
}
