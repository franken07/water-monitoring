<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $users = collect($this->firebase->getAuthUsers());

        // Stats
        $totalUsers    = $users->count();
        $activeUsers   = $users->where('disabled', false)->count();
        $inactiveUsers = $users->where('disabled', true)->count();
        $admins        = $users->filter(fn($u) => ($u['claims']['role'] ?? '') === 'admin')->count();

        // Recently Registered
        $recentUsers = $users->sortByDesc(function ($u) {
            return $u['createdAt'] ? Carbon::parse($u['createdAt']) : now();
        })->take(5);

        // Recent Logins
        $recentLogins = $users->sortByDesc(function ($u) {
            return $u['lastLogin'] ? Carbon::parse($u['lastLogin']) : now()->subYears(5);
        })->take(5);

        // Pass to your admin.index
        return view('admin.index', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'admins',
            'recentUsers',
            'recentLogins'
        ));
    }
}
