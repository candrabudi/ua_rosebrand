<div class="card p-6">
    <div class="flex-center-between pb-4 border-b border-gray-200 dark:border-dark-border mb-6">
        <h3 class="text-lg card-title leading-none">
            {{ isset($product) ? 'Edit Produk: ' . $product->name : 'Tambah Produk Baru' }}
        </h3>
        <a href="{{ route('pa.products.index') }}" class="btn b-light btn-outline">
            <i class="ri-arrow-left-line text-inherit"></i>
            <span>Kembali</span>
        </a>
    </div>

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if (isset($product))
            @method('PUT') {{-- Gunakan PUT untuk update --}}
        @endif

        <div class="grid grid-cols-2 gap-x-4 gap-y-5">
            {{-- Nama Produk (col-auto on larger screens, col-span-full on small) --}}
            <div class="col-span-full xl:col-auto leading-none">
                <label for="name" class="form-label mb-2">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}"
                    class="form-input @error('name') border-red-500 @enderror" placeholder="Contoh: Obat Batuk Sirup"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori (dengan gaya Dashkit) --}}
            <div class="col-span-full xl:col-auto leading-none">
                <label for="category_id" class="form-label mb-2">Kategori <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select id="category_id" name="category_id"
                        class="form-input form-select w-full h-11 @error('category_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Merk --}}
            <div class="col-span-full md:col-auto leading-none">
                <label for="brand" class="form-label mb-2">Merk</label>
                <input type="text" id="brand" name="brand" value="{{ old('brand', $product->brand ?? '') }}"
                    class="form-input" placeholder="Contoh: Indofarma, Kimia Farma">
            </div>

            {{-- Kemasan --}}
            <div class="col-span-full md:col-auto leading-none">
                <label for="packaging" class="form-label mb-2">Kemasan</label>
                <input type="text" id="packaging" name="packaging"
                    value="{{ old('packaging', $product->packaging ?? '') }}" class="form-input"
                    placeholder="Contoh: Botol, Strip, Blister">
            </div>

            {{-- Jumlah/Box --}}
            <div class="col-span-full md:col-auto leading-none">
                <label for="quantity_per_box" class="form-label mb-2">Jumlah/Box <span
                        class="text-red-500">*</span></label>
                <input type="number" id="quantity_per_box" name="quantity_per_box"
                    value="{{ old('quantity_per_box', $product->quantity_per_box ?? 1) }}"
                    class="form-input @error('quantity_per_box') border-red-500 @enderror" min="1"
                    placeholder="Contoh: 10, 100" required>
                @error('quantity_per_box')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div class="col-span-full md:col-auto leading-none">
                <label for="price" class="form-label mb-2">Harga <span class="text-red-500">*</span></label>
                <input type="number" step="0.01" id="price" name="price"
                    value="{{ old('price', $product->price ?? 0) }}"
                    class="form-input @error('price') border-red-500 @enderror" min="0"
                    placeholder="Contoh: 15000.00" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Satuan --}}
            <div class="col-span-full md:col-auto leading-none">
                <label for="unit_name" class="form-label mb-2">Satuan</label>
                <input type="text" id="unit_name" name="unit_name"
                    value="{{ old('unit_name', $product->unit_name ?? '') }}" class="form-input"
                    placeholder="Contoh: Tablet, Kapsul, ml">
            </div>

            {{-- Jenis Form --}}
            <div class="col-span-full md:col-auto leading-none">
                <label for="form_type" class="form-label mb-2">Jenis Form</label>
                <input type="text" id="form_type" name="form_type"
                    value="{{ old('form_type', $product->form_type ?? '') }}" class="form-input"
                    placeholder="Contoh: Padat, Cair, Gel">
            </div>
        </div> {{-- End of Main Grid for 2 columns --}}

        {{-- Deskripsi (Col span full) --}}
        <div class="col-span-full leading-none">
            <label for="description" class="form-label mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-dark-card-two dark:border-dark-border dark:text-dark-text placeholder-gray-400 @error('description') border-red-500 @enderror"
                placeholder="Jelaskan detail produk, manfaat, atau cara penggunaan...">{!! old('description', $product->description ?? '') !!}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar Produk (Col span full) --}}
        <div class="col-span-full leading-none">
            {{-- Label Judul --}}
            <label for="image_upload" class="block mt-2 text-gray-700 dark:text-gray-300 text-sm font-medium">Gambar Produk</label>

            {{-- Tombol Pilih File --}}
            <label for="image_upload"
                class="inline-flex items-center px-4 py-2 bg-primary-500 text-white font-semibold text-sm rounded-md shadow-sm cursor-pointer
               hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2
               dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-600 dk-theme-card-square transition duration-150 ease-in-out">
                <i class="ri-upload-cloud-line mr-2 me-2 text-white" style="margin-right: 15px"></i> Pilih File Gambar
                <input type="file" id="image_upload" name="image" class="hidden"
                    onchange="document.getElementById('file_name_preview').innerText = this.files[0] ? this.files[0].name : 'Tidak ada file yang dipilih';">
            </label>

            {{-- Teks Nama File di Bawah --}}
            <span id="file_name_preview" class="block mt-2 text-gray-700 dark:text-gray-300 text-sm font-medium">
                @if (isset($product) && $product->image)
                    {{ basename($product->image) }}
                @else
                    Tidak ada file yang dipilih
                @endif
            </span>

            {{-- Pesan Error --}}
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            {{-- Gambar Preview Jika Ada --}}
            @if (isset($product) && $product->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="h-28 w-auto object-cover rounded-md border border-gray-200 dark:border-dark-border shadow-sm">
                </div>
            @endif
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-dark-border mt-6">
            <button type="submit" class="btn b-light btn-secondary-light">
                Simpan
            </button>
            <a href="{{ route('pa.products.index') }}" class="btn b-light btn-danger-light">
                Batal
            </a>
        </div>
    </form>
</div>
{{-- Tambahkan custom CSS untuk form-input-file jika belum ada --}}
<style>
    .form-input-file {
        @apply block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-500 file:text-white hover:file:bg-primary-600 dark:text-dark-text dark:file:bg-primary-600 dark:file:hover:bg-primary-700 border border-gray-300 dark:border-dark-border rounded-md;
    }
</style>
