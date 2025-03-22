<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    // List Categories
    public function list()
    {
        $categories = Category::orderBy('name')->get();
        $title = "Categories";
        return view('categories.index', compact('categories', 'title'));
    }
    // Search Categories
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::where('name', 'LIKE', "%$query%")
                              ->orderBy('name')->get();
        $title = "Search Results for: " . $query;
        return view('categories.index', compact('categories', 'title'));
    }

    public function booksResult(Category $category)
    {
        // This method will fetch from database not good for model route binding
        //$books = Book::where('category_id', $category->id)->paginate(12);

        // This method will get category from route model binding
        $books = $category->books()->paginate(12);
        
        $title = "Category: $category->name";
        return view('gallery.index', compact('books', 'title'));
    }
}
