<header class="header clearfix">
    <div class="top-header-group">
        <div class="top-header">
            <div class="main_logo" id="logo">
                <a href="index.html">
                    <img src="{{ asset('user_access/images/logo_rosebrand.png') }}"
                        style="width:120px; margin: auto;" alt="">
                </a>
                <a href="index.html">
                    <img class="logo-inverse"
                        src="{{ asset('user_access/images/logo_rosebrand.png') }}"
                        style="width:120px; margin: auto;" alt="">
                </a>
            </div>

            <div class="search120">
                <form method="GET" action="{{ route('ua.products') }}" class="header_search position-relative">
                    <input class="prompt srch10" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search for products..">
                    <button type="submit" class="btn position-absolute"
                        style="right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent;">
                        <i class="uil uil-search s-icon"></i>
                    </button>
                </form>
            </div>


            <div class="header_right">
                <ul>
                    <li>
                        <a href="#" class="offer-link"><i class="uil uil-phone-alt"></i>0852293928182</a>
                    </li>

                    @if (Auth::user())
                        <li class="dropdown account-dropdown">
                            <a href="#" class="opts_account" role="button" id="accountClick"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="images/avatar/img-5.jpg" alt="">
                                <span class="user__name">{{ Auth::user()->customer->full_name }}</span>
                                <i class="uil uil-angle-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-account dropdown-menu-end"
                                aria-labelledby="accountClick">
                                <a href="{{ route('ua.dashboard') }}" class="channel_item">
                                    <i class="uil uil-apps icon__1"></i> Ringkasan
                                </a>
                                <a href="{{ route('ua.orders.index') }}" class="channel_item">
                                    <i class="uil uil-box icon__1"></i> Orderan
                                </a>
                                <a ref="{{ route('logout') }}" class="channel_item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="uil uil-lock-alt icon__1"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="sub-header-group">
        <div class="sub-header">
            <nav class="navbar navbar-expand-lg bg-gambo gambo-head navbar justify-content-lg-start pt-0 pb-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon">
                        <i class="uil uil-bars"></i>
                    </span>
                </button>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="offcanvas-logo" id="offcanvasNavbarLabel">
                            <img src="https://media.licdn.com/dms/image/v2/C560BAQFTKewNnLUpOg/company-logo_200_200/company-logo_200_200/0/1630569480047/rose_brand_logo?e=2147483647&v=beta&t=jsy-GAf7KiuVGvAi6LgwaLkD568KF2OGkvL79yLQ0l4"
                                alt="">
                        </div>
                        <button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="uil uil-multiply"></i>
                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-start flex-grow-1 pe_5">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ua.products') }}">Semua Produk</a>
                            </li>
                        </ul>
                        <div class="d-block d-lg-none">
                            <ul class="offcanvas-help-links">
                                <li>
                                    <a href="#" class="offer-link">
                                        <i class="uil uil-phone-alt"></i>
                                        08529938291
                                    </a>
                                </li>
                            </ul>
                            <div class="offcanvas-copyright">
                                <i class="uil uil-copyright"></i>
                                Copyright 2022 <b>PT Sungai Budi</b>. All rights reserved
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user())
                    <div class="sub_header_right">
                        <div class="header_cart">
                            <a href="#" class="cart__btn hover-btn" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="uil uil-shopping-cart-alt"></i><span>Cart</span><ins>2</ins><i
                                    class="uil uil-angle-down"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="sub_header_right">
                        <div class="header_cart d-flex gap-2" style="margin-right: 20px">
                            <a href="{{ route('ua.login') }}" class="btn btn-info text-white">Masuk</a>
                            <a href="{{ route('ua.register') }}" class="btn btn-warning text-white">Daftar</a>
                        </div>
                    </div>
                @endif

            </nav>
        </div>
    </div>
</header>
