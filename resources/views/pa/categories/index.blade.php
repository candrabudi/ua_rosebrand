@extends('pa.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 p-4">
        <div class="col-span-12 md:col-span-7">
            <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 sm:pb-7">
                    <div>
                        <h6 class="card-title isd">Data Kategori</h6>
                        <p class="card-description">Kelola data kategori kamu.</p>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-lg shadow-sm">
                    <table class="min-w-full leading-normal">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tl-lg">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tr-lg">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($categories as $index => $cat)
                                <tr
                                    class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $cat->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-sm break-words leading-relaxed">
                                        {{ $cat->description ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('pa.categories.edit', $cat->id) }}"
                                                class="p-2 inline-flex items-center justify-center text-blue-600 hover:text-blue-800 rounded-full hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-150 ease-in-out"
                                                title="Edit Kategori">
                                                <i class="ri-edit-line text-lg"></i>
                                            </a>

                                            <form action="{{ route('pa.categories.destroy', $cat->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 inline-flex items-center justify-center text-red-600 hover:text-red-800 rounded-full hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150 ease-in-out"
                                                    title="Hapus Kategori">
                                                    <i class="ri-delete-bin-line text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-base text-gray-500">
                                        Tidak ada data kategori yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-5">
            <div class="bg-white p-5 rounded-xl shadow">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 sm:pb-7">
                    <div>
                        <h6 class="card-title isd"> {{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}</h6>
                    </div>
                </div>

                @if (session('success'))
                    <script>
                        Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
                    </script>
                @elseif(session('error'))
                    <script>
                        Swal.fire('Oops!', '{{ session('error') }}', 'error');
                    </script>
                @endif

                <form
                    action="{{ isset($category) ? route('pa.categories.update', $category->id) : route('pa.categories.store') }}"
                    method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-input" required
                            value="{{ old('name', $category->name ?? '') }}">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" class="form-input" style="height: 300px">{{ old('description', $category->description ?? '') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn b-solid btn-primary-solid w-full dk-theme-card-square mt-5">
                            {{ isset($category) ? 'Update Kategori' : 'Tambah Kategori' }}
                        </button>
                        @if (isset($category))
                            <a href="{{ route('pa.categories.index') }}"
                                class="block text-center text-gray-500 text-sm mt-2">Batal Edit</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin?',
                    text: "Kategori akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
