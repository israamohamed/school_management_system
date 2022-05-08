<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Students\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('students.auth.login');
    }

    public function login(LoginRequest $request)
    {

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
            // Authentication was successful..
            $request->session()->regenerate();
 
            return redirect()->intended('student/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/student');
    }
}
