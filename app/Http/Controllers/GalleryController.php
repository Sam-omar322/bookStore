<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class GalleryController extends Controller
{
    public function index()
    {
        $books = Book::paginate(12);
        $title = "New Books";
        return view('gallery.index', compact('books', 'title'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $books = Book::where('title', 'like', "%$search%")->paginate(12);
        $title = "Search Results: $search";
        return view('gallery.index', compact('books', 'title'));
    }
}
