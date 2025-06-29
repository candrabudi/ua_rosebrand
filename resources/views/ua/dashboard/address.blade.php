@extends('ua.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('ua.dashboard.partials.left-side')
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title-tab">
                                <h4><i class="uil uil-location-point"></i>Alamat Saya</h4>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>Alamat Tersimpan</h4>
                                </div>
                                <div class="address-body">
                                    <a href="#" class="add-address hover-btn" data-bs-toggle="modal"
                                        data-bs-target="#addAddressModal">+ Tambah Alamat Baru</a>

                                    @foreach ($addresses as $address)
                                        <div class="address-item">
                                            <div class="address-icon1">
                                                <i class="uil uil-map-marker"></i>
                                            </div>
                                            <div class="address-dt-all">
                                                <h4>{{ $address->label }}
                                                    @if ($address->is_default)
                                                        <span class="badge bg-success">Utama</span>
                                                    @endif
                                                </h4>
                                                <p>
                                                    {{ $address->full_address }}, {{ $address->district }},
                                                    {{ $address->city }}, {{ $address->province }}<br>
                                                    <small>{{ $address->recipient_name }} -
                                                        {{ $address->phone_number }}</small>
                                                </p>
                                                <ul class="action-btns">
                                                    <li><a href="#" class="action-btn"
                                                            onclick="openEditModal({{ $address->id }})"><i
                                                                class="uil uil-edit"></i></a></li>
                                                    <li><a href="#" class="action-btn text-danger"
                                                            onclick="confirmDelete({{ $address->id }})"><i
                                                                class="uil uil-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        {{-- Hidden Form Delete --}}
                                        <form id="deleteForm{{ $address->id }}"
                                            action="{{ route('ua.address.destroy', $address->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1"
                                            role="dialog">
                                            <div class="modal-dialog category-area" role="document">
                                                <div class="category-area-inner">
                                                    <div class="modal-header">
                                                        <button type="button" class="close btn-close"
                                                            data-bs-dismiss="modal"><i
                                                                class="uil uil-multiply"></i></button>
                                                    </div>
                                                    <div class="category-model-content modal-content p-4">
                                                        <h4 class="mb-3">Edit Alamat</h4>
                                                        <form action="{{ route('ua.address.update', $address->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>Label</label>
                                                                        <input type="text" name="label"
                                                                            class="form-control"
                                                                            value="{{ $address->label }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>Nama Penerima</label>
                                                                        <input type="text" name="recipient_name"
                                                                            class="form-control"
                                                                            value="{{ $address->recipient_name }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>No. Telepon</label>
                                                                        <input type="text" name="phone_number"
                                                                            class="form-control"
                                                                            value="{{ $address->phone_number }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>Provinsi</label>
                                                                        <input type="text" name="province"
                                                                            class="form-control"
                                                                            value="{{ $address->province }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>Kota</label>
                                                                        <input type="text" name="city"
                                                                            class="form-control"
                                                                            value="{{ $address->city }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>Kecamatan</label>
                                                                        <input type="text" name="district"
                                                                            class="form-control"
                                                                            value="{{ $address->district }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group mb-3">
                                                                        <label>Alamat Lengkap</label>
                                                                        <textarea name="full_address" class="form-control" rows="2">{{ $address->full_address }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="is_default"
                                                                            {{ $address->is_default ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Jadikan alamat
                                                                            utama</label>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-success w-100">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Modal Tambah --}}
                                    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog category-area" role="document">
                                            <div class="category-area-inner">
                                                <div class="modal-header">
                                                    <button type="button" class="close btn-close"
                                                        data-bs-dismiss="modal"><i class="uil uil-multiply"></i></button>
                                                </div>
                                                <div class="category-model-content modal-content p-4">
                                                    <h4 class="mb-3">Tambah Alamat</h4>
                                                    <form action="{{ route('ua.address.store') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Label</label>
                                                                    <input type="text" name="label"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Nama Penerima</label>
                                                                    <input type="text" name="recipient_name"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>No. Telepon</label>
                                                                    <input type="text" name="phone_number"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Provinsi</label>
                                                                    <input type="text" name="province"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Kota</label>
                                                                    <input type="text" name="city"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label>Kecamatan</label>
                                                                    <input type="text" name="district"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group mb-3">
                                                                    <label>Alamat Lengkap</label>
                                                                    <textarea name="full_address" class="form-control" rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_default">
                                                                    <label class="form-check-label">Jadikan alamat
                                                                        utama</label>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary w-100">Simpan Alamat</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Script modal --}}
                                    <script>
                                        function openEditModal(id) {
                                            const modal = document.getElementById(`editAddressModal${id}`);
                                            if (modal) {
                                                const modalInstance = new bootstrap.Modal(modal);
                                                modalInstance.show();
                                            }
                                        }

                                        function confirmDelete(id) {
                                            if (confirm('Yakin ingin menghapus alamat ini?')) {
                                                document.getElementById(`deleteForm${id}`).submit();
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
