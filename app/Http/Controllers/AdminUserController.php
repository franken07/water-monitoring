<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
class AdminUserController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    // Show Firebase Authentication users
    public function index()
    {
        $users = $this->firebase->getAuthUsers();
        return view('admin.users.index', compact('users'));
    }
     // Show edit form
    public function edit($uid)
    {
        $user = $this->firebase->getUser($uid);
        return view('admin.users.edit', compact('user'));
    }

  // Create new user
public function store(Request $request)
{
    // Step 1: Create user with email & password only
    $user = $this->firebase->createUser([
        'email' => $request->email,
        'password' => $request->password,
    ]);

    $updateData = [];

    if ($request->displayName) {
        $updateData['displayName'] = $request->displayName;
    }

    if ($request->phone && preg_match('/^\+639[0-9]{9}$/', $request->phone)) {
        $updateData['phoneNumber'] = $request->phone;
    }

    // Step 2: Update user with name and phone number
    if (!empty($updateData)) {
        $this->firebase->updateUser($user->uid, $updateData);
    }

    return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
}


// Update user
public function update(Request $request, $uid)
{
    $data = [
        'email' => $request->email,
        'displayName' => $request->displayName ?: null,
    ];

    // Only update phone if valid E.164
    if ($request->phone && preg_match('/^\+639[0-9]{9}$/', $request->phone)) {
        $data['phoneNumber'] = $request->phone;
    }

    $this->firebase->updateUser($uid, $data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
}

// Delete user
public function destroy($uid)
{
    $this->firebase->deleteUser($uid);

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
}

}
