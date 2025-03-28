<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $title = 'Books Table';
        return view("admin.books.index", compact('books', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
    
        return view('admin.books.create', compact('categories', 'publishers', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'publish_id' => 'nullable|exists:publishers,id',
            'authors' => 'nullable|array',
            'authors.*' => 'exists:authors,id',
            'publish_year' => 'required|digits:4',
            'number_of_pages' => 'required|integer',
            'number_of_copies' => 'required|integer',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        // Upload and resize cover image
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $this->uploadImage($request->file('cover_image'));
        }

        // Create book
        $book = Book::create([
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'publish_id' => $validated['publish_id'] ?? null,
            'publish_year' => $validated['publish_year'],
            'number_of_pages' => $validated['number_of_pages'],
            'number_of_copies' => $validated['number_of_copies'],
            'price' => $validated['price'],
            'cover_image' => $coverImagePath,
        ]);

        // Attach authors
        if (!empty($validated['authors'])) {
            $book->authors()->attach($validated['authors']);
        }

        Session::flash('flash_message', 'Book created successfully.');
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        $authors = Author::all();
    
        return view('admin.books.edit', compact('book', 'categories', 'publishers', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'publish_id' => 'nullable|exists:publishers,id',
            'authors' => 'nullable|array',
            'authors.*' => 'exists:authors,id',
            'publish_year' => 'required|digits:4',
            'number_of_pages' => 'required|integer',
            'number_of_copies' => 'required|integer',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        // Check if ISBN is dirty
        if ($book->isDirty('isbn')) {
            $book->isbn = $validated['isbn'];
        }

        // Check image
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->cover_image = $this->uploadImage($request->file('cover_image'));
        }

        // Update other fields
        $book->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'publish_id' => $validated['publish_id'],
            'publish_year' => $validated['publish_year'],
            'number_of_pages' => $validated['number_of_pages'],
            'number_of_copies' => $validated['number_of_copies'],
            'price' => $validated['price'],
        ]);

        // Detach and reattach authors
        $book->authors()->detach();
        if (!empty($validated['authors'])) {
            $book->authors()->attach($validated['authors']);
        }

        Session::flash('flash_message', 'Book updated successfully.');
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete cover image if exists
        if ($book->cover_image) {
            $this->deleteImage($book->cover_image);
        }

        // Delete the book
        $book->delete();

        Session::flash('flash_message', 'Book deleted successfully.');
        return redirect()->route('books.index');
    }

    public function details(Book $book)
    {
        $bookfind = 0;
        if (Auth::check()) {
            $bookfind = auth()->user()->ratedpurches()->where('book_id', $book->id)->first();
        }
        return view('book.details', compact('book', 'bookfind'));
    }

    public function rate(Request $request, Book $book)
    {
        if(auth()->user()->rated($book)) {
            $rating = Rating::where(['user_id' => auth()->user()->id, 'book_id' => $book->id])->first();
            $rating->value = $request->value;
            $rating->save();
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->book_id = $book->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}
