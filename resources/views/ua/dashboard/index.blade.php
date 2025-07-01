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
                                <h4><i class="uil uil-apps"></i>Ringkasan</h4>
                            </div>
                            <div class="welcome-text">
                                <h2>Halo, {{ $customer->full_name }}</h2>
                            </div>

                            @if (!$hasAddress)
                                <div class="alert alert-warning mt-3">
                                    <strong>Alamat belum tersedia!</strong> Silakan tambahkan alamat terlebih dahulu untuk
                                    dapat melakukan pemesanan.
                                    <a href="{{ route('ua.address.index') }}" class="btn btn-sm btn-primary ml-2">Tambah
                                        Alamat</a>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>Total Pesanan</h4>
                                </div>
                                <div class="ddsh-body">
                                    <h2>{{ $totalOrders }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>Total Keranjang</h4>
                                </div>
                                <div class="ddsh-body">
                                    <h2>{{ $totalCartItems }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pdpt-bg">
                                <div class="pdpt-title">
                                    <h4>Total Pengeluaran</h4>
                                </div>
                                <div class="ddsh-body">
                                    <h2>Rp{{ number_format($totalSpent, 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="card shadow-sm border-0 rounded-4 mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0 fw-semibold">
                                            <i class="uil uil-map-marker-alt me-1"></i> Alamat Utama
                                        </h5>
                                        @if ($defaultAddress)
                                            <a href="{{ route('ua.address.index') }}"
                                                class="btn btn-sm btn-warning text-white">
                                                <i class="uil uil-edit"></i> Ubah
                                            </a>
                                        @endif
                                    </div>

                                    @if ($defaultAddress)
                                        <div class="ps-2">
                                            <div class="mb-2">
                                                <h6 class="fw-bold mb-1">{{ $defaultAddress->label }}</h6>
                                                <div class="text-muted small">
                                                    <i class="uil uil-user me-1"></i> {{ $defaultAddress->recipient_name }}
                                                    &bull;
                                                    <i class="uil uil-phone me-1"></i> {{ $defaultAddress->phone_number }}
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <div class="text-muted">
                                                    <i class="uil uil-map-pin-alt me-1"></i>
                                                    {{ $defaultAddress->district }}, {{ $defaultAddress->city }},
                                                    {{ $defaultAddress->province }}
                                                </div>
                                            </div>

                                            <div>
                                                <p class="mb-0 text-muted">
                                                    <i class="uil uil-location-point me-1"></i>
                                                    {{ $defaultAddress->full_address }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning mb-0">
                                            Tidak ada alamat utama yang tersimpan. <a
                                                href="{{ route('ua.address.index') }}" class="alert-link">Tambah
                                                sekarang</a>.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 mt-3">
                            <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                    <h4 class="mb-0">Pesanan Terbaru</h4>
                                </div>

                                <div class="ddsh-body">
                                    @php use Carbon\Carbon; @endphp

                                    @php
                                        $badgeColors = [
                                            'pending' => 'warning',
                                            'paid' => 'info',
                                            'shipped' => 'secondary',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                            'default' => 'light',
                                        ];

                                        $statusTranslations = [
                                            'pending' => 'Menunggu Pembayaran',
                                            'paid' => 'Sudah Dibayar',
                                            'shipped' => 'Sedang Dikirim',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];
                                    @endphp

                                    @forelse ($recentOrders as $order)
                                        @php
                                            $status = $order->status;
                                            $badgeColor = $badgeColors[$status] ?? $badgeColors['default'];
                                            $translatedStatus = $statusTranslations[$status] ?? ucfirst($status);
                                        @endphp

                                        <div class="mb-4 pb-3 border-bottom">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ count($order->orderItems) }} Barang -
                                                        <span class="badge bg-{{ $badgeColor }}">
                                                            {{ $translatedStatus }}
                                                        </span>
                                                    </h6>
                                                    <small class="text-muted">
                                                        Tanggal:
                                                        {{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, H:i') }}
                                                    </small>
                                                </div>
                                            </div>

                                            <ul class="mt-2">
                                                @foreach ($order->orderItems as $item)
                                                    <li class="text-muted">
                                                        {{ $item->product->name ?? 'Produk Tidak Diketahui' }} ×
                                                        {{ $item->quantity }} @
                                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @empty
                                        <div class="text-muted">Belum ada pesanan terbaru.</div>
                                    @endforelse

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
