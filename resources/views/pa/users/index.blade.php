@extends('pa.layouts.app')

@section('content')
    <div class="card p-0">
        <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
            <h3 class="text-lg card-title leading-none">Daftar Admin & Employee</h3>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('pa.users.create') }}" class="btn-primary inline-flex items-center gap-2">
                    <i class="ri-add-line"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="flex-center-between">
                <form method="GET" action="{{ route('pa.users.index') }}"
                    class="max-w-80 relative flex items-center gap-2">
                    <span class="absolute top-1/2 -translate-y-[40%] left-2.5">
                        <i class="ri-search-line text-gray-900 dark:text-dark-text text-[14px]"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                        class="form-input pl-[30px] w-full">
                    <button type="submit"
                        class="font-spline_sans text-sm px-1 text-gray-900 dark:text-dark-text flex-center gap-1.5">
                        <i class="ri-loop-right-line text-inherit text-sm"></i>
                        <span>Cari</span>
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto mt-5">
                <table class="table-auto w-full whitespace-nowrap text-left text-gray-500 dark:text-dark-text font-medium">
                    <thead>
                        <tr class="text-primary-500">
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">#</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">Username</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">Role</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-dark-border-three">
                        @forelse ($users as $i => $user)
                            <tr>
                                <td class="p-4">{{ $users->firstItem() + $i }}</td>
                                <td class="p-4">{{ $user->username }}</td>
                                <td class="p-4 capitalize">{{ $user->role }}</td>
                                <td class="p-6 py-4 text-center space-x-2">
                                    <div class="flex items-center gap-2 justify-center">
                                        <a href="{{ route('pa.users.edit', $user->id) }}"
                                            class="btn-icon btn-warning-icon-light size-7">
                                            <i class="ri-edit-line text-inherit text-[13px]"></i>
                                        </a>

                                        @if (auth()->id() !== $user->id)
                                            <form action="{{ route('pa.users.destroy', $user->id) }}" method="POST"
                                                class="inline-block delete-form">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-icon btn-danger-icon-light size-7">
                                                    <i class="ri-delete-bin-line text-inherit text-[13px]"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">Tidak ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex-center-between mt-5">
                <div class="text-sm text-gray-900 dark:text-dark-text">
                    Menampilkan {{ $users->firstItem() }} hingga {{ $users->lastItem() }} dari
                    {{ $users->total() }} entri
                </div>
                <div>{{ $users->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
@endpush
