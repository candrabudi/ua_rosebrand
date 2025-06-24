@extends('pa.layouts.app')

@section('content')
    <div class="card p-6 max-w-xl mx-auto">
        <h3 class="text-lg font-semibold mb-4">Edit User</h3>

        <form action="{{ route('pa.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="username" class="block font-medium mb-1">Username</label>
                <input type="text" name="username" id="username" class="form-input w-full"
                    value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium mb-1">Password Baru (opsional)</label>
                <input type="password" name="password" id="password" class="form-input w-full">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full">
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('pa.users.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
