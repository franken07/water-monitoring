<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show the edit form for a specific user
    public function edit($id)
    {
        $user = User::find($id); // Fetch user by ID
        return view('users.edit', compact('user')); // Pass user data to the edit view
    }

    // Update user data in the database
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'usertype' => 'nullable|string|max:50',
        ]);

        // Update user attributes
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->usertype = $request->input('usertype');
        $user->save();

        // Redirect with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
}