@extends('ua.layouts.app')

@section('content')
    <div class="gambo-Breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('ua.home') }}">Home</a> ></li>
                            <li class="breadcrumb-item active" aria-current="page">Semua Produk Rosebrand</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="all-product-grid">
        <div class="container">

            <div class="row mb-4">
                <form method="GET" action="{{ route('ua.products') }}">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3 mb-2">
                            <select name="category_id" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select name="sort" class="form-select">
                                <option value="">Sortir</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>A-Z</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <button class="btn btn-primary w-100" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                @forelse ($products as $product)
                    <div class="col-lg-3 col-md-6 mt-3">
                        <div class="product-item mb-30">
                            <a href="#" class="product-img">
                                <img src="{{ asset('storage/' . ($product->image ?? 'placeholder.jpg')) }}" alt="">
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
                                        data-product-image="{{ asset('storage/' . ($product->image ?? 'placeholder.jpg')) }}">
                                        <i class="uil uil-shopping-cart-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <p>Produk tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <nav>
                            <ul class="pagination">
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                @endif

                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                @if ($products->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
