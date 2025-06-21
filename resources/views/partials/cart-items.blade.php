@foreach ($cartItems as $item)
    <div class="cart-item">
        <div class="cart-product-img">
            <img src="{{ asset('storage/' . $item->product->image) }}" alt="">
        </div>
        <div class="cart-text">
            <h4>{{ $item->product->name }}</h4>
            <div class="qty-group">
                <div class="quantity buttons_added">
                    <input type="number" value="{{ $item->quantity }}" class="input-text qty text" disabled>
                </div>
                <div class="cart-item-price">
                    Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                </div>
            </div>
            <button type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </div>
@endforeach
