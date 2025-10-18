<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->withDatabaseUri(config('firebase.database_url'));

        $this->database = $factory->createDatabase();
        $this->auth = $factory->createAuth();
    }

    // 🔹 Realtime Database
    public function getSensorData()
    {
        try {
            return $this->database->getReference('sensors')->getValue();
        } catch (\Exception $e) {
            \Log::error('Firebase Fetch Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getUserLogins()
    {
        return $this->database->getReference('user_logins')->getValue();
    }

    // 🔹 Authentication Users
    public function getAuthUsers()
    {
        $users = [];
        foreach ($this->auth->listUsers() as $user) {
            $users[] = [
                'uid'       => $user->uid,
                'email'     => $user->email,
                'name'      => $user->displayName ?? 'N/A',
                'phone'     => $user->phoneNumber ?? 'N/A',
                'createdAt' => $user->metadata->creationTime ?? null,
                'lastLogin' => $user->metadata->lastSignInTime ?? null,
                'disabled'  => $user->disabled ?? false,
                'claims'    => $user->customClaims ?? [],
            ];
        }
        return $users;
    }

    public function getUser($uid)
    {
        $user = $this->auth->getUser($uid);

        return [
            'uid' => $user->uid,
            'email' => $user->email,
            'displayName' => $user->displayName,
            'phoneNumber' => $user->phoneNumber,
        ];
    }

    public function updateUser($uid, $data)
    {
        return $this->auth->updateUser($uid, $data);
    }

    public function deleteUser($uid)
    {
        return $this->auth->deleteUser($uid);
    }

    public function createUser($data)
    {
        return $this->auth->createUser([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
    public function updateUserLoginStatus($uid, $deviceId, $status)
{
    try {
        $ref = "user_logins/{$uid}/{$deviceId}/status";
        $this->database->getReference($ref)->set($status);
        return true;
    } catch (\Exception $e) {
        \Log::error('Firebase update error: ' . $e->getMessage());
        return false;
    }
}

}