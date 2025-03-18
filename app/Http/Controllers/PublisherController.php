<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::orderBy('name')->get();
        $title = "All Publishers";
        return view('publishers.index', compact('publishers', 'title'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $publishers = Publisher::where('name', 'LIKE', "%$query%")->orderBy('name')->get();
        $title = "Search Results for: " . $query;
        return view('publishers.index', compact('publishers', 'title'));
    }
    
    public function booksResult(Publisher $publisher)
    {
        $books = $publisher->books()->paginate(12);
        
        $title = "Publisher: $publisher->name";
        return view('gallery.index', compact('books', 'title'));
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
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}
