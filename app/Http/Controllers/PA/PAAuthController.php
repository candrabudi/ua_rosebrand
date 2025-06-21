<?php

namespace App\Http\Controllers\PA;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PAAuthController extends Controller
{
    public function loginView()
    {
        return view('pa.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withInput()
                ->with([
                    'toast' => 'Username atau password salah.',
                    'toast_type' => 'linear-gradient(to right, #ff5f6d, #ffc371)', // Red-orange
                ]);
        }

        Auth::login($user);

        return redirect()->route('pa.dashboard.index')->with([
            'toast' => 'Login berhasil. Selamat datang, ' . $user->username . '!',
            'toast_type' => 'linear-gradient(to right, #00b09b, #96c93d)',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pa.login')->with([
            'toast' => 'Anda telah logout.',
            'toast_type' => 'linear-gradient(to right, #ff5f6d, #ffc371)',
        ]);
    }
}
