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
        $title = 'Publishers Table';
        return view('admin.publishers.index', compact('publishers', 'title'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
     
        $publisher = new Publisher;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();
     
        session()->flash('flash_message',  'Publisher added successfully');
     
        return redirect(route('publishers.index'));
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
        return view('admin.publishers.edit', compact('publisher'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $this->validate($request, ['name' => 'required']);
     
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();
     
        session()->flash('flash_message',  'Publisher updated successfully');
     
        return redirect(route('publishers.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
     
        session()->flash('flash_message','Publisher deleted successfully');
     
        return redirect(route('publishers.index'));
    }

    // List Publishers
    public function list()
    {
        $publishers = Publisher::orderBy('name')->get();
        $title = "Publishers";
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
}
