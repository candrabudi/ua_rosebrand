@extends('ua.layouts.app')

@section('content')
    <style>
        .order-product-list img {
            object-fit: cover;
        }

        .bs-wizard-step.complete .progress-bar {
            background-color: #4caf50;
        }

        .bs-wizard-step.active .progress-bar {
            background-color: #ffc107;
        }

        .bs-wizard-step.disabled .progress-bar {
            background-color: #e0e0e0;
        }

        .bs-wizard-step {
            flex: 1;
            text-align: center;
        }

        .bs-wizard-step .progress {
            height: 4px;
            margin-top: 10px;
        }

        .bs-wizard-dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            background: #6c757d;
            border-radius: 50%;
            margin-top: 5px;
        }

        .bs-wizard-step.complete .bs-wizard-dot {
            background: #4caf50;
        }

        .bs-wizard-step.active .bs-wizard-dot {
            background: #ffc107;
        }
    </style>

    <div class="container">
        <div class="row">
            @include('ua.dashboard.partials.left-side')

            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-title-tab">
                                <h4><i class="uil uil-box"></i>Riwayat Pesanan</h4>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            @php use Carbon\Carbon; @endphp

                            @forelse ($orders as $order)
                                <div class="bg-white rounded-4 shadow-sm mb-5 p-4 p-md-5">
                                    <div class="d-flex justify-content-between flex-wrap mb-4 border-bottom pb-3">
                                        <div>
                                            <h5 class="mb-1">Pesanan #{{ $order->id }}</h5>
                                            <small class="text-muted">Waktu Pemesanan:
                                                {{ Carbon::parse($order->ordered_at)->format('d M Y, H:i') }}</small>
                                        </div>
                                        <div class="text-end mt-2 mt-md-0">
                                            <span
                                                class="badge bg-warning text-dark px-3 py-2">{{ ucfirst($order->status) }}</span><br>
                                            <small class="text-muted">Metode:
                                                <strong>{{ strtoupper($order->payment_method) }}</strong></small>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold">Dikirim ke:</h6>
                                        <p class="mb-1">{{ $order->address->recipient_name }} -
                                            {{ $order->address->phone_number }}</p>
                                        <small class="text-muted">{{ $order->address->full_address }},
                                            {{ $order->address->district }}, {{ $order->address->city }},
                                            {{ $order->address->province }}</small>
                                    </div>

                                    <div class="order-product-list mb-4">
                                        @foreach ($order->orderItems as $item)
                                            <div class="d-flex align-items-start gap-3 mb-4 pb-3 border-bottom">
                                                <img src="{{ asset('storage/' . $item->product->image ?? 'images/groceries.svg') }}"
                                                    alt="{{ $item->product->name }}" width="80" height="80"
                                                    class="rounded shadow-sm">
                                                <div>
                                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">{{ $item->quantity }} x
                                                        @Rp{{ number_format($item->price, 0, ',', '.') }}</small><br>
                                                    <strong
                                                        class="text-dark">Rp{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($order->payment && $order->payment->method === 'transfer' && $order->payment->proof)
                                        <div class="mb-4">
                                            <h6 class="fw-bold">Bukti Transfer:</h6>
                                            <a href="{{ asset('storage/' . $order->payment->proof) }}" download
                                                class="btn btn-sm btn-outline-primary mt-2">
                                                Download Bukti Transfer
                                            </a>
                                        </div>
                                    @endif

                                    <div class="border-top pt-3">
                                        @php
                                            $subtotal = $order->orderItems->sum(fn($i) => $i->quantity * $i->price);
                                        @endphp
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal</span>
                                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Ongkos Kirim</span>
                                            <span>Gratis</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-top pt-3 mt-2 fw-bold fs-5">
                                            <span>Total</span>
                                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info mt-3">Belum ada pesanan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
