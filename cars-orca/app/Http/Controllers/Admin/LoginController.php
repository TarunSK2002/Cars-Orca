<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['error' => 'Invalid username or password'])->withInput();
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Auth::logout();
        session()->forget('admin_logged_in');
        return redirect()->route('home')->with('success', 'Logged out safely.');
    }
}
