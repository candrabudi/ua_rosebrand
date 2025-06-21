<div class="col-xl-3 col-lg-4 col-md-12">
    <div class="left-side-tabs">
        <div class="dashboard-left-links">
            <a href="{{ route('ua.dashboard') }}"
                class="user-item {{ Route::is('ua.dashboard') ? 'active' : '' }}">
                <i class="uil uil-apps"></i>Ringkasan
            </a>

            <a href="{{ route('ua.orders.index') }}"
                class="user-item {{ Route::is('ua.orders.*') ? 'active' : '' }}">
                <i class="uil uil-box"></i>Riwayat Pesanan
            </a>

            <a href="{{ route('ua.address.index') }}"
                class="user-item {{ Route::is('ua.address.*') ? 'active' : '' }}">
                <i class="uil uil-location-point"></i>Alamat
            </a>

            <a href="{{ route('logout') }}" class="user-item"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="uil uil-exit"></i>Keluar
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
