<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $title = "Users Table";
        return view("admin.users.index", compact('users', 'title'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate role
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        // Update user role
        $user->role = $request->role;
        $user->save();
    
        
        Session::flash('flash_message', 'User role updated successfully.');
        return redirect()->route('users.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    { 
        $user->delete();
        Session::flash('flash_message', 'User deleted successfully.');
        return redirect()->route('users.index');
    }
}
