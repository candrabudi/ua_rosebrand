@extends('pa.layouts.app')

@section('content')
    <div class="card p-0">
        <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
            <h3 class="text-lg card-title leading-none">Daftar Produk</h3>
        </div>
        <div class="p-6">
            <div class="flex-center-between">
                <div class="flex items-center gap-5">
                    <form method="GET" action="{{ route('pa.products.index') }}"
                        class="max-w-80 relative flex items-center gap-2">
                        <span class="absolute top-1/2 -translate-y-[40%] left-2.5">
                            <i class="ri-search-line text-gray-900 dark:text-dark-text text-[14px]"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                            class="form-input pl-[30px] w-full">
                        <button type="submit"
                            class="font-spline_sans text-sm px-1 text-gray-900 dark:text-dark-text flex-center gap-1.5">
                            <i class="ri-loop-right-line text-inherit text-sm"></i>
                            <span>Cari</span>
                        </button>
                    </form>

                </div>
                <a href="{{ route('pa.products.create') }}" class="btn b-light btn-primary-light dk-theme-card-square">
                    <i class="ri-add-fill text-inherit"></i>
                    <span>Tambah Data</span>
                </a>
            </div>
            <div class="overflow-x-auto mt-5">
                <table
                    class="table-auto border-collapse w-full whitespace-nowrap text-left text-gray-500 dark:text-dark-text font-medium">
                    <thead>
                        <tr class="text-primary-500">
                            <th
                                class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two first:rounded-l-lg last:rounded-r-lg first:dk-theme-card-square-left last:dk-theme-card-square-right">
                                #</th>
                            <th
                                class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two first:rounded-l-lg last:rounded-r-lg first:dk-theme-card-square-left last:dk-theme-card-square-right">
                                Gambar</th>
                            <th
                                class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two first:rounded-l-lg last:rounded-r-lg first:dk-theme-card-square-left last:dk-theme-card-square-right">
                                Nama</th>
                            <th
                                class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two first:rounded-l-lg last:rounded-r-lg first:dk-theme-card-square-left last:dk-theme-card-square-right">
                                Kategori</th>
                            <th
                                class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two first:rounded-l-lg last:rounded-r-lg first:dk-theme-card-square-left last:dk-theme-card-square-right">
                                Harga</th>
                            <th
                                class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two first:rounded-l-lg last:rounded-r-lg first:dk-theme-card-square-left last:dk-theme-card-square-right w-10 text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-dark-border-three">
                        @forelse ($products as $i => $product)
                            <tr>
                                <td class="p-6 py-4">{{ $i + 1 }}</td>
                                <td class="p-6 py-4">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="h-12 w-12 object-cover rounded">
                                    @else
                                        <div
                                            class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                                            <i class="ri-image-line text-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-6 py-4">{{ $product->name }}</td>
                                <td class="p-6 py-4">{{ $product->category->name ?? '-' }}</td>
                                <td class="p-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="p-6 py-4 text-center space-x-2">
                                    <div class="flex items-center gap-2 justify-center">
                                        <a href="{{ route('pa.products.edit', $product->id) }}"
                                            class="btn-icon btn-primary-icon-light size-7">
                                            <i class="ri-edit-line text-inherit text-[13px]"></i>
                                        </a>
                                        <form action="{{ route('pa.products.destroy', $product->id) }}" method="POST"
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
                                <td colspan="6" class="p-6 py-4 text-center text-gray-500">Tidak ada data produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex-center-between mt-5">
                <div class="font-spline_sans text-sm text-gray-900 dark:text-dark-text">
                    Menampilkan {{ $products->firstItem() }} hingga {{ $products->lastItem() }} dari
                    {{ $products->total() }} entri
                </div>
                <nav>
                    <ul class="flex items-center gap-1">
                        {{-- Previous Page Link --}}
                        @if ($products->onFirstPage())
                            <li>
                                <span
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-400 dark:text-gray-600 bg-gray-100 dark:bg-dark-card-two cursor-not-allowed">
                                    <i class="ri-arrow-left-s-line text-inherit"></i>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $products->previousPageUrl() }}"
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text hover:bg-primary-500 hover:text-white dark:bg-dark-card-two">
                                    <i class="ri-arrow-left-s-line text-inherit"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($products->links()->elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li>
                                    <span
                                        class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text">
                                        <i class="ri-more-fill text-inherit"></i>
                                    </span>
                                </li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <li>
                                        <a href="{{ $url }}"
                                            class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text {{ $page == $products->currentPage() ? 'active bg-primary-500 text-white' : '' }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($products->hasMorePages())
                            <li>
                                <a href="{{ $products->nextPageUrl() }}"
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text hover:bg-primary-500 hover:text-white dark:bg-dark-card-two">
                                    <i class="ri-arrow-right-s-line text-inherit"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <span
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-400 dark:text-gray-600 bg-gray-100 dark:bg-dark-card-two cursor-not-allowed">
                                    <i class="ri-arrow-right-s-line text-inherit"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
@endpush
