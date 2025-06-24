@extends('pa.layouts.app')

@section('content')
    <div class="card max-w-xl mx-auto p-6">
        <h3 class="text-lg font-semibold mb-4">Pengaturan Akun</h3>

        @if (session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pa.account.update') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="username" class="block font-medium mb-1">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                    class="form-input w-full" required>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr class="my-6">

            <h4 class="text-md font-semibold mb-2">Ganti Password</h4>

            <div class="mb-4">
                <label for="current_password" class="block font-medium mb-1">Password Saat Ini</label>
                <input type="password" name="current_password" id="current_password" class="form-input w-full">
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="new_password" class="block font-medium mb-1">Password Baru</label>
                <input type="password" name="new_password" id="new_password" class="form-input w-full">
                @error('new_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="new_password_confirmation" class="block font-medium mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="form-input w-full">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn b-light btn-primary-light dk-theme-card-square">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
