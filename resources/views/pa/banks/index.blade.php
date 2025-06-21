@extends('pa.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 p-4">
        <!-- KIRI: Table Bank -->
        <div class="col-span-12 md:col-span-7">
            <div class="bg-white p-6 rounded-lg shadow-xl border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 sm:pb-7">
                    <div>
                        <h6 class="card-title isd">Data Bank</h6>
                        <p class="card-description">Kelola data rekening bank kamu.</p>
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
                                    Nama Bank
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nama Akun
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nomor Akun
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tr-lg">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($banks as $index => $dbank)
                                <tr
                                    class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $dbank->bank_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $dbank->account_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $dbank->account_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('pa.banks.edit', $dbank->id) }}"
                                                class="p-2 inline-flex items-center justify-center text-blue-600 hover:text-blue-800 rounded-full hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-150 ease-in-out"
                                                title="Edit Bank">
                                                <i class="ri-edit-line text-lg"></i>
                                            </a>

                                            <form action="{{ route('pa.banks.destroy', $dbank->id) }}" method="POST"
                                                class="inline-block delete-form"
                                                >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 inline-flex items-center justify-center text-red-600 hover:text-red-800 rounded-full hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150 ease-in-out"
                                                    title="Hapus Bank">
                                                    <i class="ri-delete-bin-line text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-base text-gray-500">
                                        Tidak ada data bank yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- KANAN: Form Tambah / Edit -->
        <div class="col-span-12 md:col-span-5">
            <div class="bg-white p-5 rounded-xl shadow">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-3 sm:pb-7">
                    <div>
                        <h6 class="card-title isd"> {{ isset($bank) ? 'Edit Bank' : 'Tambah Bank' }}</h6>
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
                    action="{{ isset($bank) ? route('pa.banks.update', $bank->id) : route('pa.banks.store') }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @if (isset($bank))
                        @method('PUT')
                    @endif

                    <div>
                        <label for="bank_name" class="block text-sm font-medium text-gray-700">Nama Bank</label>
                        <select name="bank_name" id="bank_name" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                            <option value="">Pilih Bank</option>
                            <option value="BCA" {{ old('bank_name', $bank->bank_name ?? '') == 'BCA' ? 'selected' : '' }}>BCA</option>
                            <option value="BNI" {{ old('bank_name', $bank->bank_name ?? '') == 'BNI' ? 'selected' : '' }}>BNI</option>
                            <option value="BRI" {{ old('bank_name', $bank->bank_name ?? '') == 'BRI' ? 'selected' : '' }}>BRI</option>
                            <option value="Mandiri" {{ old('bank_name', $bank->bank_name ?? '') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                            <option value="CIMB Niaga" {{ old('bank_name', $bank->bank_name ?? '') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                            <option value="Bank Danamon" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Danamon' ? 'selected' : '' }}>Bank Danamon</option>
                            <option value="PermataBank" {{ old('bank_name', $bank->bank_name ?? '') == 'PermataBank' ? 'selected' : '' }}>PermataBank</option>
                            <option value="BTN" {{ old('bank_name', $bank->bank_name ?? '') == 'BTN' ? 'selected' : '' }}>BTN</option>
                            <option value="Bank Mega" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Mega' ? 'selected' : '' }}>Bank Mega</option>
                            <option value="OCBC NISP" {{ old('bank_name', $bank->bank_name ?? '') == 'OCBC NISP' ? 'selected' : '' }}>OCBC NISP</option>
                            <option value="Bank Syariah Indonesia (BSI)" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Syariah Indonesia (BSI)' ? 'selected' : '' }}>Bank Syariah Indonesia (BSI)</option>
                            <option value="PaninBank" {{ old('bank_name', $bank->bank_name ?? '') == 'PaninBank' ? 'selected' : '' }}>PaninBank</option>
                            <option value="Bank Maybank Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Maybank Indonesia' ? 'selected' : '' }}>Bank Maybank Indonesia</option>
                            <option value="Bank BTN Syariah" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank BTN Syariah' ? 'selected' : '' }}>Bank BTN Syariah</option>
                            <option value="Bank BTPN" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank BTPN' ? 'selected' : '' }}>Bank BTPN</option>
                            <option value="Bank Sinarmas" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Sinarmas' ? 'selected' : '' }}>Bank Sinarmas</option>
                            <option value="Bank Bukopin" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Bukopin' ? 'selected' : '' }}>Bank Bukopin</option>
                            <option value="Bank Jabar Banten (BJB)" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Jabar Banten (BJB)' ? 'selected' : '' }}>Bank Jabar Banten (BJB)</option>
                            <option value="Bank DKI" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank DKI' ? 'selected' : '' }}>Bank DKI</option>
                            <option value="Bank Jateng" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Jateng' ? 'selected' : '' }}>Bank Jateng</option>
                            <option value="Bank Jatim" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Jatim' ? 'selected' : '' }}>Bank Jatim</option>
                            <option value="Bank Papua" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Papua' ? 'selected' : '' }}>Bank Papua</option>
                            <option value="Bank Nagari" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Nagari' ? 'selected' : '' }}>Bank Nagari</option>
                            <option value="Bank Aceh Syariah" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Aceh Syariah' ? 'selected' : '' }}>Bank Aceh Syariah</option>
                            <option value="Bank Riau Kepri" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Riau Kepri' ? 'selected' : '' }}>Bank Riau Kepri</option>
                            <option value="Bank Sumut" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Sumut' ? 'selected' : '' }}>Bank Sumut</option>
                            <option value="Bank Sumsel Babel" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Sumsel Babel' ? 'selected' : '' }}>Bank Sumsel Babel</option>
                            <option value="Bank Lampung" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Lampung' ? 'selected' : '' }}>Bank Lampung</option>
                            <option value="Bank Bengkulu" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Bengkulu' ? 'selected' : '' }}>Bank Bengkulu</option>
                            <option value="Bank Jambi" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Jambi' ? 'selected' : '' }}>Bank Jambi</option>
                            <option value="Bank Kalimantan Barat" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Kalimantan Barat' ? 'selected' : '' }}>Bank Kalimantan Barat</option>
                            <option value="Bank Kalimantan Tengah" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Kalimantan Tengah' ? 'selected' : '' }}>Bank Kalimantan Tengah</option>
                            <option value="Bank Kalimantan Selatan" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Kalimantan Selatan' ? 'selected' : '' }}>Bank Kalimantan Selatan</option>
                            <option value="Bank Kaltimtara" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Kaltimtara' ? 'selected' : '' }}>Bank Kaltimtara</option>
                            <option value="Bank Sulawesi Utara dan Gorontalo (BSG)" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Sulawesi Utara dan Gorontalo (BSG)' ? 'selected' : '' }}>Bank Sulawesi Utara dan Gorontalo (BSG)</option>
                            <option value="Bank Sultra" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Sultra' ? 'selected' : '' }}>Bank Sultra</option>
                            <option value="Bank NTB Syariah" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank NTB Syariah' ? 'selected' : '' }}>Bank NTB Syariah</option>
                            <option value="Bank NTT" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank NTT' ? 'selected' : '' }}>Bank NTT</option>
                            <option value="Bank Maluku Malut" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Maluku Malut' ? 'selected' : '' }}>Bank Maluku Malut</option>
                            <option value="Bank Papua" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Papua' ? 'selected' : '' }}>Bank Papua</option>
                            <option value="Bank Victoria International" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Victoria International' ? 'selected' : '' }}>Bank Victoria International</option>
                            <option value="Bank Artha Graha Internasional" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Artha Graha Internasional' ? 'selected' : '' }}>Bank Artha Graha Internasional</option>
                            <option value="Bank Commonwealth" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Commonwealth' ? 'selected' : '' }}>Bank Commonwealth</option>
                            <option value="Bank Ekonomi Raharja" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Ekonomi Raharja' ? 'selected' : '' }}>Bank Ekonomi Raharja</option>
                            <option value="Bank Ganesha" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Ganesha' ? 'selected' : '' }}>Bank Ganesha</option>
                            <option value="Bank ICBC Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank ICBC Indonesia' ? 'selected' : '' }}>Bank ICBC Indonesia</option>
                            <option value="Bank KEB Hana Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank KEB Hana Indonesia' ? 'selected' : '' }}>Bank KEB Hana Indonesia</option>
                            <option value="Bank MNC Internasional" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank MNC Internasional' ? 'selected' : '' }}>Bank MNC Internasional</option>
                            <option value="Bank Muamalat Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Muamalat Indonesia' ? 'selected' : '' }}>Bank Muamalat Indonesia</option>
                            <option value="Bank OCBC NISP Syariah" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank OCBC NISP Syariah' ? 'selected' : '' }}>Bank OCBC NISP Syariah</option>
                            <option value="Bank Pembangunan Daerah (BPD) Lainnya" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Pembangunan Daerah (BPD) Lainnya' ? 'selected' : '' }}>Bank Pembangunan Daerah (BPD) Lainnya</option>
                            <option value="Bank Rakyat Indonesia Agroniaga" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Rakyat Indonesia Agroniaga' ? 'selected' : '' }}>Bank Rakyat Indonesia Agroniaga</option>
                            <option value="Bank QNB Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank QNB Indonesia' ? 'selected' : '' }}>Bank QNB Indonesia</option>
                            <option value="Bank UOB Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank UOB Indonesia' ? 'selected' : '' }}>Bank UOB Indonesia</option>
                            <option value="Bank Woori Saudara Indonesia 1906" {{ old('bank_name', $bank->bank_name ?? '') == 'Bank Woori Saudara Indonesia 1906' ? 'selected' : '' }}>Bank Woori Saudara Indonesia 1906</option>
                            <option value="Citibank N.A." {{ old('bank_name', $bank->bank_name ?? '') == 'Citibank N.A.' ? 'selected' : '' }}>Citibank N.A.</option>
                            <option value="Deutsche Bank AG" {{ old('bank_name', $bank->bank_name ?? '') == 'Deutsche Bank AG' ? 'selected' : '' }}>Deutsche Bank AG</option>
                            <option value="HSBC Indonesia" {{ old('bank_name', $bank->bank_name ?? '') == 'HSBC Indonesia' ? 'selected' : '' }}>HSBC Indonesia</option>
                            <option value="J.P. Morgan Chase Bank, N.A." {{ old('bank_name', $bank->bank_name ?? '') == 'J.P. Morgan Chase Bank, N.A.' ? 'selected' : '' }}>J.P. Morgan Chase Bank, N.A.</option>
                            <option value="Standard Chartered Bank" {{ old('bank_name', $bank->bank_name ?? '') == 'Standard Chartered Bank' ? 'selected' : '' }}>Standard Chartered Bank</option>
                            <option value="The Bank of Tokyo-Mitsubishi UFJ, Ltd." {{ old('bank_name', $bank->bank_name ?? '') == 'The Bank of Tokyo-Mitsubishi UFJ, Ltd.' ? 'selected' : '' }}>The Bank of Tokyo-Mitsubishi UFJ, Ltd.</option>
                        </select>
                        @error('bank_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="account_name" class="block text-sm font-medium text-gray-700">Nama Akun</label>
                        <input type="text" name="account_name" id="account_name"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                            required value="{{ old('account_name', $bank->account_name ?? '') }}">
                        @error('account_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="account_number" class="block text-sm font-medium text-gray-700">Nomor Akun</label>
                        <input type="text" name="account_number" id="account_number"
                            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                            required value="{{ old('account_number', $bank->account_number ?? '') }}">
                        @error('account_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="btn b-solid btn-primary-solid w-full dk-theme-card-square mt-5 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md shadow-md transition duration-300">
                            {{ isset($bank) ? 'Update Bank' : 'Tambah Bank' }}
                        </button>
                        @if (isset($bank))
                            <a href="{{ route('pa.banks.index') }}"
                                class="block text-center text-gray-500 text-sm mt-2 hover:underline">Batal Edit</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin?',
                    text: "Data bank akan dihapus permanen!",
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
