<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::orderBy('name')->get();
        $title = "Authors Table";
        return view('admin.authors.index', compact('authors', 'title'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
     
        $author = new Author;
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();
     
        session()->flash('flash_message',  'Author successfully added!');
     
        return redirect(route('authors.index'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $this->validate($request, ['name' => 'required']);
     
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();
     
        session()->flash('flash_message',  'Author successfully updated!');
     
        return redirect(route('authors.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
     
        session()->flash('flash_message','Author successfully deleted!');
     
        return redirect(route('authors.index'));
    }

    // List Authors
    public function list()
    {
        $authors = Author::orderBy('name')->get();
        $title = "Authors";
        return view('authors.index', compact('authors', 'title'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $authors = Author::where('name', 'LIKE', "%$query%")->orderBy('name')->get();
        $title = "Search Results for: " . $query;
        return view('authors.index', compact('authors', 'title'));
    }

    public function booksResult(Author $author)
    {
        $books = $author->books()->paginate(12);
        
        $title = "Author: $author->name";
        return view('gallery.index', compact('books', 'title'));
    }
}
