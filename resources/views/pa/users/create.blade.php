@extends('pa.layouts.app')

@section('content')
    <div class="card p-6 max-w-xl mx-auto">
        <h3 class="text-lg font-semibold mb-4">Tambah User Baru</h3>

        <form action="{{ route('pa.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="username" class="block font-medium mb-1">Username</label>
                <input type="text" name="username" id="username" class="form-input w-full" value="{{ old('username') }}"
                    required>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" class="form-input w-full" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full"
                    required>
            </div>

            <div class="mb-4">
                <label for="role" class="block font-medium mb-1">Role</label>
                <select name="role" id="role" class="form-input form-select w-full h-11" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Pekerja</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('pa.users.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
