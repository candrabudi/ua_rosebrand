@extends('ua.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('ua.dashboard.partials.left-side')
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="dashboard-right">
                    <div class="pdpt-bg p-4">
                        <h4 class="mb-4">Edit Profil Saya</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('ua.profile.update') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="full_name" class="form-control"
                                        value="{{ old('full_name', $customer->full_name) }}" required>
                                    @error('full_name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', $customer->phone_number) }}" required>
                                    @error('phone_number')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Password Saat Ini</label>
                                    <input type="password" name="current_password" class="form-control">
                                    @error('current_password')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" class="form-control">
                                    @error('new_password')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" class="form-control">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
