<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\Candidate;

class UserAuthenticationController extends Controller
{
    public function login()
    {
        // Check if the user is already logged in
        if (Session::has('loginId')) {
            $userId = Session::get('loginId');
            $user = User::find($userId);
    
            // Redirect to the appropriate dashboard based on user's role
            if ($user && $user->username === 'admin') {
                return redirect()->route('usermanage.dashboard');
            } else {
                return redirect('./login');
            }
        } else {
            // If not logged in, show the login page
            return view("auth.login");
        }
    }

        public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to find the user by username
        $user = User::where('username', $request->username)->first();

        if ($user) {
            // Check if the provided password matches the user's password
            if ($request->password === $user->password) {
                // Log the user in based on their role
                if ($user->username === 'admin') {
                    // If the user is admin, redirect to admin dashboard
                    $request->session()->put('loginId', $user->id);
                    return redirect('usermanage/dashboard');
                } else {
                    // For other users, redirect to judge dashboard
                    $request->session()->put('loginId', $user->id);
                    return redirect('judge/judgeDashboard');
                }
            } else {
                // Flash error message for incorrect password
                Session::flash('fail', 'Password does not match');
                return back()->with('fail', 'Password does not match');
            }
        } else {
            // Flash error message for unregistered username
            Session::flash('fail', 'This username is not registered');
            return back()->with('fail', 'This username is not registered');
        }
    }

    public function dashboard()
    {
        $users = User::where('username', '!=', 'admin')->get();
        return view('usermanage.dashboard', compact('users'));
    }
    
    public function logout()
    {
        Session::forget('loginId'); // Remove 'loginId' from session
        return redirect('login'); // Redirect to the login page after logout
    }
}

