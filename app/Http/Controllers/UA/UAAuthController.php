<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UAAuthController extends Controller
{
    public function register()
    {
        return view('ua.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        Customer::create([
            'user_id' => $user->id,
            'full_name' => $validated['full_name'],
            'phone_number' => $validated['phone_number'],
        ]);

        Auth::login($user);
        return redirect()->route('ua.dashboard')->with('success', 'Registration successful!');
    }

    public function login()
    {
        return view('ua.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'customer') {
                Auth::logout();
                return back()->withErrors(['username' => 'Unauthorized role.']);
            }

            $request->session()->regenerate();
            return redirect()->route('ua.dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('ua.login')->with('success', 'Logged out successfully!');
    }
}
