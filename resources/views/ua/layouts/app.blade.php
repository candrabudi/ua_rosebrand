<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="PT  Sungai Budi">
    <meta name="author" content="PT  Sungai Budi">
    <title>@yield('title') - PT Sungai Budi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="images/fav.png">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link href='{{ asset('user_access/vendor/unicons-2.0.1/css/unicons.css') }}' rel='stylesheet'>
    <link href="{{ asset('user_access/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/css/night-mode.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/css/step-wizard.css') }}" rel="stylesheet">

    <link href="{{ asset('user_access/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user_access/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <style>
        .cart-text {
            position: relative;
        }

        .cart-close-btn {
            background: none;
            border: none;
            color: #999;
            font-size: 18px;
            cursor: pointer;
        }

        .cart-close-btn:hover {
            color: #e74c3c;
        }
    </style>

    <style>
        .featured-slider .item {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-item {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            min-height: 400px;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            box-sizing: border-box;
            background: #fff;
            transition: all 0.2s ease-in-out;
        }

        .product-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .product-img img {
            height: 180px;
            width: 100%;
            object-fit: contain;
            border-radius: 5px;
        }
    </style>
    <style>
        .wrapper {
            background: linear-gradient(135deg, #e3f2fd 0%, #e8f0f7 100%);
            min-height: 100vh;
        }
    </style>

    <style>
        .gemini-toast {
            background-color: #323232;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            margin-top: 10px;
            min-width: 220px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', sans-serif;
        }

        .gemini-toast.success {
            background-color: #4caf50;
        }

        .gemini-toast.error {
            background-color: #f44336;
        }

        .gemini-toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

</head>

<body>
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bs-canvas-header side-cart-header p-3">
            <div class="d-inline-block main-cart-title" id="offcanvasRightLabel">Keranjang Saya <span>(2 Items)</span>
            </div>
            <button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="uil uil-multiply"></i>
            </button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="cart-top-total p-4">
                <div class="cart-total-dil">
                    <h4>PT Sungai Budi</h4>
                </div>
            </div>

            <div class="side-cart-items">

            </div>

            <div class="cart-item d-none cart-item-template">
                <div class="cart-product-img">
                    <img src="" alt="">
                    <div class="offer-badge">6% OFF</div>
                </div>
                <div class="cart-text">
                    <h4 class="product-title">Product Title</h4>
                    <div class="cart-radio">
                        <ul class="kggrm-now">

                        </ul>
                    </div>
                    <div class="qty-group">
                        <div class="quantity buttons_added">
                            <input type="button" value="-" class="minus minus-btn">
                            <input type="number" step="1" name="quantity" value="1"
                                class="input-text qty text">
                            <input type="button" value="+" class="plus plus-btn">
                        </div>
                        <div class="cart-item-price">Rp0 </div>
                    </div>
                    <button type="button" class="cart-close-btn"><i class="uil uil-multiply"></i></button>
                </div>
            </div>
        </div>

        <div class="offcanvas-footer">
            <div class="main-total-cart">
                <h2>Total</h2>
                <span id="cart-total">Rp0</span>
            </div>
            <div class="checkout-cart">
                <a href="{{ route('ua.checkout.index') }}" class="cart-checkout-btn hover-btn">Checkout Sekarang</a>
            </div>
        </div>
    </div>

    @include('ua.layouts.header')

    <div class="wrapper">
        @yield('content')
    </div>
    @include('ua.layouts.footer')
    <script src="{{ asset('user_access/js/jquery.min.js') }}"></script>
    <script src="{{ asset('user_access/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user_access/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('user_access/vendor/OwlCarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('user_access/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('user_access/js/custom.js') }}"></script>
    <script src="{{ asset('user_access/js/offset_overlay.js') }}"></script>
    <script src="{{ asset('user_access/js/night-mode.js') }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `gemini-toast ${type}`;
            toast.innerHTML = `<div class="toast-body">${message}</div>`;
            document.getElementById('toast-container').appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        function updateCartCount() {
            fetch('/ua/cart/count')
                .then(res => res.json())
                .then(data => {
                    const count = data.count ?? 0;
                    document.querySelector('.header_cart ins').textContent = count;
                    document.querySelector('.main-cart-title span').textContent = `(${count} Items)`;
                });
        }

        function loadCart() {
            fetch('/ua/cart/list')
                .then(res => res.json())
                .then(data => {
                    document.querySelector('.main-cart-title span').innerHTML = `(${data.total_items} Items)`;
                    document.querySelector('.header_cart ins').innerHTML = data.total_items;
                    document.querySelector('.main-total-cart span').innerHTML = formatRupiah(data.total);

                    const container = document.querySelector('.side-cart-items');
                    container.innerHTML = '';

                    data.items.forEach(item => {
                        const maxNameLength = 25;
                        const displayName = item.name.length > maxNameLength ?
                            item.name.substring(0, maxNameLength) + '...' :
                            item.name;

                        container.innerHTML += `
                            <div class="cart-item" data-id="${item.id}">
                                <div class="cart-product-img">
                                    <img src="${item.image}" alt="${item.name}">
                                    <div class="offer-badge">Sale</div>
                                </div>
                                <div class="cart-text d-flex justify-content-between align-items-start">
                                    <div class="w-100 pe-2">
                                        <h4 title="${item.name}" class="mb-1">${displayName}</h4>
                                        <div class="qty-group">
                                            <div class="quantity buttons_added">
                                                <input type="button" value="-" class="minus minus-btn">
                                                <input type="number" value="${item.quantity}" class="input-text qty text">
                                                <input type="button" value="+" class="plus plus-btn">
                                            </div>
                                            <div class="cart-item-price">${formatRupiah(item.subtotal)}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="cart-close-btn ms-2" data-id="${item.id}" title="Hapus item">
                                        <i class="uil uil-multiply"></i>
                                    </button>
                                </div>
                            </div>`;
                    });

                    bindCartEvents();
                });
        }

        function bindCartEvents() {
            document.querySelectorAll('.cart-close-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    fetch(`/ua/cart/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                loadCart();
                                updateCartCount();
                                showToast('Item berhasil dihapus dari keranjang.', 'success');
                            } else {
                                showToast('Gagal menghapus item.', 'error');
                            }
                        });
                });
            });

            document.querySelectorAll('.plus-btn, .minus-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const container = this.closest('.cart-item');
                    const input = container.querySelector('input.qty');
                    const cartId = container.dataset.id;
                    let quantity = parseInt(input.value);

                    if (this.classList.contains('plus-btn')) {
                        quantity++;
                    } else {
                        quantity = Math.max(1, quantity - 1);
                    }

                    input.value = quantity;

                    updateCartQty(cartId, quantity);
                });
            });

            document.querySelectorAll('input.qty').forEach(input => {
                input.addEventListener('change', function () {
                    const container = this.closest('.cart-item');
                    const cartId = container.dataset.id;
                    let quantity = parseInt(this.value);

                    if (isNaN(quantity) || quantity < 1) {
                        quantity = 1;
                        this.value = 1;
                    }

                    updateCartQty(cartId, quantity);
                });
            });
        }

        function updateCartQty(cartId, quantity) {
            fetch('/ua/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    quantity: quantity
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadCart();
                        updateCartCount();
                        showToast('Jumlah berhasil diperbarui.', 'success');
                    } else {
                        showToast('Gagal memperbarui kuantitas.', 'error');
                    }
                })
                .catch(err => {
                    console.error('Gagal update qty:', err);
                    showToast('Terjadi kesalahan saat update.', 'error');
                });
        }

        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const quantity = this.closest('.qty-cart')
                    .querySelector('input[name="quantity"]').value;

                fetch('/ua/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            updateCartCount();
                            loadCart();
                            showToast('Berhasil ditambahkan ke keranjang!', 'success');
                        } else {
                            showToast('Gagal menambahkan ke keranjang.', 'error');
                        }
                    })
                    .catch(() => {
                        showToast('Terjadi kesalahan saat menambahkan.', 'error');
                    });
            });
        });

        updateCartCount();
        loadCart();
    });
</script>



</body>

</html>
