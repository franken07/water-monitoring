<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class AuthController extends Controller
{
    public function firebaseLogin(Request $request)
    {
        $token = $request->input('token');
    
        try {
            $firebase = (new Factory)
                        ->withServiceAccount(base_path('storage/swqms-466f1-firebase-adminsdk-fbsvc-766564fe4c.json'))
                        ->createAuth();
    
            $verifiedIdToken = $firebase->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');
    
            if ($uid === 'TfMGlRD9eth7JzdSdluS388aSsv1'|| $uid === '4hzmpXk449cPCs7rJHyfXQNNmuz2') {
                // Admin account login logic
                session([
                    'uid' => $uid,
                    'firebase_logged_in' => true,
                    'is_admin' => true,
                ]);
                return response()->json(['success' => true, 'message' => 'Admin login successful!']);
            } else {
                // End user login logic
                session([
                    'uid' => $uid,
                    'firebase_logged_in' => true,
                    'is_admin' => false,
                ]);
                return response()->json(['success' => true, 'message' => 'User login successful!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Invalid token. Please try again.'], 401);
        }
    }   

    // Add logout function
    public function logout(Request $request)
    {
        $request->session()->forget('firebase_logged_in');
        $request->session()->forget('uid');
        return redirect('/');
    }
}
