<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserAuthenticationController extends Controller
{
    public function login()
    {
        if (Session::has('loginId')) {
            $userId = Session::get('loginId');
            $user = User::find($userId);

            if ($user) {
                switch ($user->role) {
                    case 'admin':
                        return redirect()->route('usermanage.dashboardMain');
                    case 'judge_prelim':
                        return redirect()->route('judge.judge_dashboard');
                    case 'judge_gown':
                        return redirect()->route('judge.gown_table');
                    case 'judge_semi':
                        return redirect()->route('judge.semi_finals_dash');
                    case 'judge_final':
                        return redirect()->route('judge.finals_dash');
                }
            }
        }

        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'unique_code' => 'required_without:username', // Validate unique_code without requiring username
            'username' => 'required_without:unique_code', // Validate username without requiring unique_code
            'password' => 'required_with:username', // Require password only when username is present
        ]);

        if ($request->has('unique_code')) {
            $user = User::where('unique_code', $request->unique_code)
                        ->whereIn('role', ['admin', 'judge_prelim', 'judge_gown', 'judge_semi', 'judge_final'])
                        ->first();
        } else {
            $user = User::where('username', $request->username)
                        ->where('password', $request->password)
                        ->first();
        }

        if ($user) {
            $request->session()->put('loginId', $user->id);
            $request->session()->put('userName', $user->name);

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('usermanage.dashboardMain');
                case 'judge_prelim':
                    return redirect()->route('judge.judge_dashboard');
                case 'judge_gown':
                    return redirect()->route('judge.gown_table');
                case 'judge_semi':
                    return redirect()->route('judge.semi_finals_dash');
                case 'judge_final':
                    return redirect()->route('judge.finals_dash');
                default:
                    return redirect()->route('default.dashboard');
            }
        } else {
            return back()->with('fail', 'Invalid credentials');
        }
    }
    
    public function logout()
    {
        Session::forget(['loginId', 'userName']);
        return redirect('login');
    }
}
