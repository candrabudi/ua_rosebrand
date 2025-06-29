@extends('ua.layouts.app')

@section('content')
    <style>
        .payment-secure {
            cursor: pointer;
        }
    </style>
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('ua.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('ua.checkout.store') }}" method="POST">
        @csrf
        <div class="checkout-step">
            <div class="container">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-8">
                        <div class="card p-4 mb-4">
                            <h4>Delivery Address</h4>
                            <div class="address-body">
                                @foreach ($addresses as $address)
                                    <div
                                        class="address-item mb-3 {{ $defaultAddress && $defaultAddress->id === $address->id ? 'selected' : '' }}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="address_id"
                                                id="address_{{ $address->id }}" value="{{ $address->id }}"
                                                {{ old('address_id', $defaultAddress?->id) == $address->id ? 'checked' : '' }}>
                                            <label class="form-check-label d-flex w-100" for="address_{{ $address->id }}">
                                                <div class="address-icon1 me-3">
                                                    <i class="uil uil-map-marker"></i>
                                                </div>
                                                <div class="address-dt-all">
                                                    <h5 class="mb-1">{{ $address->label }}</h5>
                                                    <p class="mb-0">{{ $address->full_address }}</p>
                                                    <small>{{ $address->recipient_name }} -
                                                        {{ $address->phone_number }}</small>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($addresses->isEmpty())
                                    <p class="text-danger">Belum ada alamat tersedia.</p>
                                @endif
                            </div>
                        </div>

                        <div class="card p-4">
                            <h4>Payment Method</h4>
                            <div class="payment-method">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" value="cod"
                                        id="cod" checked>
                                    <label class="form-check-label" for="cod">
                                        <strong>Cash on Delivery (COD)</strong>
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" value="transfer"
                                        id="transfer">
                                    <label class="form-check-label" for="transfer">
                                        <strong>Transfer Bank</strong>
                                    </label>
                                </div>

                                <div class="mt-3" id="bank-selection" style="display: none;">
                                    <label class="form-label">Pilih Bank</label>
                                    @foreach ($banks as $bank)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="bank_id"
                                                id="bank_{{ $bank->id }}" value="{{ $bank->id }}">
                                            <label class="form-check-label" for="bank_{{ $bank->id }}">
                                                <strong>{{ $bank->bank_name }}</strong> - a.n.
                                                {{ $bank->account_name }}<br>
                                                No. Rekening: {{ $bank->account_number }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-4 col-md-5">
                        <div class="pdpt-bg mt-0">
                            <div class="pdpt-title">
                                <h4>Ringkasan Belanja</h4>
                            </div>
                            <div class="right-cart-dt-body">
                                @php
                                    $total = 0;
                                    $totalSaving = 0;
                                @endphp
                                @foreach ($cartItems as $item)
                                    @php
                                        $product = $item->product;
                                        $price = $product->price;
                                        $originalPrice = $product->original_price ?? $price;
                                        $qty = $item->quantity;
                                        $subtotal = $price * $qty;
                                        $saving = ($originalPrice - $price) * $qty;
                                        $total += $subtotal;
                                        $totalSaving += $saving;
                                    @endphp
                                    <div class="cart-item border_radius">
                                        <div class="cart-product-img">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                            @if ($originalPrice > $price)
                                                <div class="offer-badge">
                                                    {{ round((($originalPrice - $price) / $originalPrice) * 100) }}%
                                                    OFF
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cart-text">
                                            <h4>{{ $product->name }}</h4>
                                            <div class="cart-item-price">
                                                Rp{{ number_format($price, 0, ',', '.') }}
                                                @if ($originalPrice > $price)
                                                    <span>Rp{{ number_format($originalPrice, 0, ',', '.') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="total-checkout-group">
                                <div class="cart-total-dil">
                                    <h4>Total Belanja</h4>
                                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="cart-total-dil pt-3">
                                    <h4>Ongkir</h4>
                                    <span>Rp0</span>
                                </div>
                            </div>


                            <div class="main-total-cart p-4">
                                <h2>Total</h2>
                                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <div class="payment-secure cart-checkout-btn hover-btn clickable-submit" style="width: 100%; text-align: center; color: #fff; cursor: pointer;">
                                <i class="uil uil-padlock"></i> Checkout Sekarang
                            </div>
                            <script>
                                document.querySelector('.clickable-submit').addEventListener('click', function() {
                                    this.closest('form').submit();
                                });
                            </script>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cod = document.getElementById('cod');
            const transfer = document.getElementById('transfer');
            const bankSelection = document.getElementById('bank-selection');

            function toggleBank() {
                bankSelection.style.display = transfer.checked ? 'block' : 'none';
            }

            cod.addEventListener('change', toggleBank);
            transfer.addEventListener('change', toggleBank);
            toggleBank();
        });
    </script>
@endsection
