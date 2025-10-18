<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class AdminUserLoginController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        // Existing data
        $totalUsers = count($this->firebase->getAuthUsers());
        $activeUsers = $totalUsers; // adjust if you have logic for active users
        $recentUsers = array_slice($this->firebase->getAuthUsers(), 0, 5);
        $recentLogins = array_slice($recentUsers, 0, 5);

        // 🔹 Fetch user logins from Firebase
        $userLogins = $this->firebase->getUserLogins() ?? [];

        // Restructure data (Firebase nested UID → deviceId)
        $formattedLogins = [];
        foreach ($userLogins as $uid => $devices) {
            foreach ($devices as $deviceId => $info) {
                $formattedLogins[] = [
                    'uid'        => $uid,
                    'deviceId'   => $deviceId,
                    'deviceName' => $info['deviceName'] ?? 'Unknown',
                    'ipAddress'  => $info['ipAddress'] ?? 'N/A',
                    'status'     => $info['status'] ?? 'pending',
                    'timestamp'  => $info['timestamp'] ?? '',
                ];
            }
        }

        // ✅ FIXED: load the correct view for user logins
      return view('admin.user_logins.index', [
    'userLogins' => $formattedLogins,
]);

    }

    // 🔹 Approve a login
    public function approveLogin($uid, $deviceId)
    {
        $this->firebase->updateUserLoginStatus($uid, $deviceId, 'approved');
        return back()->with('success', 'Login approved!');
    }

    // 🔹 Reject a login
    public function rejectLogin($uid, $deviceId)
    {
        $this->firebase->updateUserLoginStatus($uid, $deviceId, 'rejected');
        return back()->with('success', 'Login rejected!');
    }
    public function fetchTable()
{
    $userLogins = $this->firebase->getUserLogins() ?? [];

    $formattedLogins = [];
    foreach ($userLogins as $uid => $devices) {
        foreach ($devices as $deviceId => $info) {
            $formattedLogins[] = [
                'uid'        => $uid,
                'deviceId'   => $deviceId,
                'deviceName' => $info['deviceName'] ?? 'Unknown',
                'ipAddress'  => $info['ipAddress'] ?? 'N/A',
                'status'     => $info['status'] ?? 'pending',
                'timestamp'  => $info['timestamp'] ?? '',
            ];
        }
    }

    return view('admin.user_logins.table', compact('formattedLogins'));
}
}
