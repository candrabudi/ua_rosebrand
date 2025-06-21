@extends('ua.layouts.app')

@section('content')
    <div class="section145">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-title-tt">
                        <div class="main-title-left">
                            <span>Rekomendasi untukmu</span>
                            <h2>Produk terlaris dari RoseBrand</h2>
                        </div>
                        <a href="shop_grid.html" class="see-more-btn">Lihat Semua</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="owl-carousel featured-slider owl-theme">
                        @foreach ($topRosebrandProducts as $product)
                            <div class="item">
                                <div class="product-item">
                                    <a href="" class="product-img">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        <div class="product-absolute-options">
                                            <span class="offer-badge-1">Best Seller</span>
                                            <span class="like-icon" title="wishlist"></span>
                                        </div>
                                    </a>
                                    <div class="product-text-dt">
                                        <p>Available<span>(In Stock)</span></p>
                                        <h4>{{ $product->name }}</h4>
                                        <div class="product-price">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                        <div class="qty-cart">
                                            <div class="quantity buttons_added">
                                                <input type="button" value="-" class="minus minus-btn">
                                                <input type="number" step="1" name="quantity" value="1"
                                                    class="input-text qty text">
                                                <input type="button" value="+" class="plus plus-btn">
                                            </div>
                                            <span class="cart-icon add-to-cart-btn" data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}"
                                                data-product-price="{{ $product->price }}"
                                                data-product-image="{{ asset('storage/' . $product->image ?? 'placeholder.jpg') }}">
                                                <i class="uil uil-shopping-cart-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

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

    @foreach ($categories as $category)
        <div class="section145">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-title-tt">
                            <div class="main-title-left">
                                <span>Rekomendasi Kategori Terbaik</span>
                                <h2>{{ $category->name }}</h2>
                            </div>
                            <a href="" class="see-more-btn">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="owl-carousel featured-slider owl-theme">
                            @foreach ($category->products as $product)
                                <div class="item">
                                    <div class="product-item">
                                        <a href="" class="product-img position-relative d-block">
                                            <img src="{{ asset('storage/' . $product->image ?? 'placeholder.jpg') }}"
                                                alt="{{ $product->name }}">
                                            <div class="product-absolute-options">
                                                <span class="offer-badge-1">Best Deal</span>
                                                <span class="like-icon" title="wishlist"></span>
                                            </div>
                                        </a>
                                        <div class="product-text-dt">
                                            <p>Available <span>(In Stock)</span></p>
                                            <h4>{{ $product->name }}</h4>
                                            <div class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}
                                            </div>
                                            <div class="qty-cart">
                                                <div class="quantity buttons_added">
                                                    <input type="button" value="-" class="minus minus-btn">
                                                    <input type="number" step="1" name="quantity" value="1"
                                                        class="input-text qty text">
                                                    <input type="button" value="+" class="plus plus-btn">
                                                </div>
                                                <span class="cart-icon add-to-cart-btn"
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->name }}"
                                                    data-product-price="{{ $product->price }}"
                                                    data-product-image="{{ asset('storage/' . $product->image ?? 'placeholder.jpg') }}">
                                                    <i class="uil uil-shopping-cart-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
