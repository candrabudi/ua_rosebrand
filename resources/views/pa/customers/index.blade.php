@extends('pa.layouts.app')

@section('content')
    <div class="card p-0">
        <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
            <h3 class="text-lg card-title leading-none">Daftar Customer</h3>
        </div>
        <div class="p-6">
            <div class="flex-center-between">
                <form method="GET" action="{{ route('pa.customers.index') }}"
                    class="max-w-80 relative flex items-center gap-2">
                    <span class="absolute top-1/2 -translate-y-[40%] left-2.5">
                        <i class="ri-search-line text-gray-900 dark:text-dark-text text-[14px]"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari customer..."
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
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">Nama</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">Username</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">No. HP</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two">Alamat</th>
                            <th class="p-4 bg-[#F2F4F9] dark:bg-dark-card-two text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-dark-border-three">
                        @forelse ($customers as $i => $customer)
                            <tr>
                                <td class="p-4">{{ $customers->firstItem() + $i }}</td>
                                <td class="p-4">{{ $customer->full_name }}</td>
                                <td class="p-4">{{ $customer->user->username ?? '-' }}</td>
                                <td class="p-4">{{ $customer->phone_number }}</td>
                                <td class="p-4">
                                    {{ optional($customer->addresses->first())->full_address ?? '-' }}
                                </td>

                                <td class="p-6 py-4 text-center space-x-2">
                                    <div class="flex items-center gap-2 justify-center">
                                        <a href="{{ route('pa.customers.show', $customer->id) }}"
                                            class="btn-icon btn-primary-icon-light size-7">
                                            <i class="ri-eye-line text-inherit text-[13px]"></i>
                                        </a>
                                        <form action="{{ route('pa.customers.destroy', $customer->id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-icon btn-danger-icon-light size-7">
                                                <i class="ri-delete-bin-line text-inherit text-[13px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">Tidak ada data customer.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex-center-between mt-5">
                <div class="text-sm text-gray-900 dark:text-dark-text">
                    Menampilkan {{ $customers->firstItem() }} hingga {{ $customers->lastItem() }} dari
                    {{ $customers->total() }} entri
                </div>
                <div>{{ $customers->links() }}</div>
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
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endpush
