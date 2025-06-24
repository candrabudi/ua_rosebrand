<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class UAProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $customer = $user->customer;

        return view('ua.profile.edit', compact('user', 'customer'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $customer = $user->customer;

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'full_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->username = $request->username;
        $user->save();

        $customer->full_name = $request->full_name;
        $customer->phone_number = $request->phone_number;
        $customer->save();

        return redirect()->route('ua.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
