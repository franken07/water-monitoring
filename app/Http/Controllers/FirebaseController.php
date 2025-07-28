<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    protected $database;

    public function __construct()
    {
        // Load Firebase credentials from the JSON file
        $factory = (new Factory)->withServiceAccount(base_path('firebase_credentials.json'));

        // Initialize Firebase Database
        $this->database = $factory->createDatabase();
    }

    public function fetchUserLogins()
    {
        // Reference the 'user_logins' node in Firebase Realtime Database
        $reference = $this->database->getReference('user_logins');

        // Get all user login records
        $logins = $reference->getValue();

        // Pass the data to the Blade view
        return view('admin.user_logins', compact('logins'));
    }
}