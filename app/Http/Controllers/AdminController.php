<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;

class AdminController extends Controller
{
    public function index() {
        $n_of_books = Book::all()->count();
        $n_of_publishers = Publisher::all()->count();
        $n_of_authors = Author::all()->count();
        $n_of_categories = Category::all()->count();
        return view("admin.index", compact("n_of_books", "n_of_publishers", "n_of_authors", "n_of_categories"));
    }
}
