<?php

namespace App\Http\Controllers\PA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PAUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->whereIn('role', ['admin', 'employee']);

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        return view('pa.users.index', compact('users'));
    }

    public function create()
    {
        return view('pa.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|string',
        ]);

        // Validasi manual untuk role
        if (!in_array($request->role, ['admin', 'employee'])) {
            return redirect()->back()->withInput()->withErrors(['role' => 'Role tidak valid.']);
        }

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('pa.users.index')->with('success', 'User berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $user = User::whereIn('role', ['admin', 'employee'])->findOrFail($id);
        return view('pa.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::whereIn('role', ['admin', 'employee'])->findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->username = $validated['username'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('pa.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus diri sendiri.');
        }

        $user->delete();

        return redirect()->route('pa.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('pa.users.account', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
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

        return redirect()->route('pa.account.edit')->with('success', 'Akun berhasil diperbarui.');
    }
}
