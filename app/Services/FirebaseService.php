<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        if (!$this->database) { // Avoid unnecessary re-initialization
            $factory = (new Factory)
                ->withServiceAccount(config('firebase.credentials'))
                ->withDatabaseUri(config('firebase.database_url'));
    
            $this->database = $factory->createDatabase();
        }
    }

    // Fetching data from Firebase Realtime Database
    public function getSensorData()
    {
        try {
            $data = $this->database->getReference('sensors')->getValue();
    
            \Log::info('Raw Sensor Data: ', (array) $data);
    
            return $data;
        } catch (\Exception $e) {
            \Log::error('Firebase Fetch Error: ' . $e->getMessage());
            return [];
        }
    }
    public function getUserLogins()
    {
        return $this->database->getReference('user_logins')->getValue();
    }
    
}
