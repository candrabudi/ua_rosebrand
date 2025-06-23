@php
    $baseLinkClasses =
        'relative text-gray-500 dark:text-dark-text-two font-medium leading-none px-3.5 py-3 h-[42px] flex items-center group/menu-link ac-transition group-data-[sidebar-size=sm]:bg-gray-100 dark:group-data-[sidebar-size=sm]:bg-dark-icon group-data-[sidebar-size=sm]:hover:bg-primary-500/95 group-data-[sidebar-size=sm]:[&.active]:bg-primary-500/95 hover:text-white [&.active]:text-white hover:!bg-primary-500/95 [&.active]:bg-primary-500/95 group-data-[sidebar-size=sm]:rounded-lg group-data-[sidebar-size=sm]:group-hover/sm:!rounded-br-none group-data-[sidebar-size=lg]:rounded-l-full group-data-[sidebar-size=sm]:p-3 group-data-[sidebar-size=sm]:w-full';

    $baseDropdownContentClasses =
        "dropdown-content transition-all duration-300 max-h-0 overflow-hidden hidden group-data-[sidebar-size=sm]:bg-white dark:group-data-[sidebar-size=sm]:bg-dark-tooltip group-data-[sidebar-size=sm]:!max-h-max group-data-[sidebar-size=sm]:overflow-visible group-data-[sidebar-size=lg]:block peer-[.show]/dp-btn:my-1.5 group-data-[sidebar-size=sm]:!my-0 group-data-[sidebar-size=lg]:w-[calc(theme('spacing.app-menu')_-_16px)] group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_2.5)] group-data-[sidebar-size=sm]:absolute group-data-[sidebar-size=sm]:left-[calc(theme('spacing.app-menu-sm')_*_0.9)] top-full group-data-[sidebar-size=sm]:group-hover/sm:block group-data-[sidebar-size=sm]:shadow-menu-dropdown";

    $baseSubLinkClasses =
        'relative peer/link text-gray-500 dark:text-dark-text-two font-medium leading-none px-5 py-2.5 group-data-[sidebar-size=lg]:pl-8 flex hover:text-primary-500 dark:hover:text-dark-text [&.active]:text-primary-500 dark:[&.active]:text-dark-text before:absolute before:top-[49%] before:-translate-y-1/2 before:left-4 before:size-1.5 before:rounded-50 before:border before:border-gray-400 dark:before:border-text-dark hover:before:border-none hover:before:bg-primary-400 dark:hover:before:bg-text-dark [&.active]:before:border-none group-data-[sidebar-size=sm]:after:block group-data-[sidebar-size=sm]:after:right-3 [&.active]:before:bg-primary-400 dark:[&.active]:before:bg-text-dark group-data-[sidebar-size=sm]:before:hidden';

@endphp
<div id="app-menu-drawer"
    class="app-menu flex flex-col gap-y-2.5 bg-white dark:bg-dark-card w-app-menu fixed top-0 left-0 bottom-0 -translate-x-full group-data-[sidebar-size=sm]:min-h-screen group-data-[sidebar-size=sm]:h-max xl:translate-x-0 rounded-r-10 xl:rounded-15 xl:group-data-[sidebar-size=lg]:w-app-menu xl:group-data-[sidebar-size=sm]:w-app-menu-sm xl:group-data-[sidebar-size=sm]:absolute xl:group-data-[sidebar-size=lg]:fixed xl:top-4 xl:left-4 xl:bottom-4 z-backdrop xl:group-data-[theme-width=box]:left-auto dk-theme-card-square ac-transition"
    tabindex="-1">
    <div
        class="px-4 h-header flex items-center shrink-0 group-data-[sidebar-size=sm]:px-2 group-data-[sidebar-size=sm]:justify-center">
        <a href="index.html" class="group-data-[sidebar-size=lg]:block hidden">
            <img src="{{ asset('user_access/images/logo_rosebrand.png') }}" alt="logo" class="group-[.dark]:hidden"
                width="120">
            <img src="{{ asset('user_access/images/logo_rosebrand.png') }}" alt="logo" class="group-[.light]:hidden"
                width="120">
        </a>
        <a href="index.html" class="group-data-[sidebar-size=lg]:hidden block">
            <img src="{{ asset('user_access/images/logo_rosebrand.png') }}" alt="logo" width="120">
        </a>
    </div>
    <div id="app-menu-scrollbar" data-scrollbar
        class="pl-4 group-data-[sidebar-size=sm]:pl-0 group-data-[sidebar-size=sm]:!overflow-visible !overflow-x-hidden smooth-scrollbar">
        <div class="group-data-[sidebar-size=lg]:max-h-full">
            <ul id="navbar-nav"
                class="text-[14px] !leading-none space-y-1 group-data-[sidebar-size=sm]:space-y-2.5 group-data-[sidebar-size=sm]:flex group-data-[sidebar-size=sm]:flex-col group-data-[sidebar-size=sm]:items-start group-data-[sidebar-size=sm]:mx-2 group-data-[sidebar-size=sm]:overflow-visible">
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="{{ route('pa.dashboard.index') }}"
                        class="{{ $baseLinkClasses }} {{ request()->routeIs('pa.dashboard.index') ? 'active' : '' }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-dashboard-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="#"
                        class="dropdown-button top-layer {{ $baseLinkClasses }} peer/dp-btn {{ request()->routeIs(['pa.products.*', 'pa.categories.*']) ? 'active' : '' }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-box-3-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Produk & Kategori
                        </span>
                    </a>
                    <div class="{{ $baseDropdownContentClasses }}">
                        <ul class="text-[14px] pl-1.5 group-data-[sidebar-size=sm]:pl-0">
                            <li class="relative group/sub">
                                <a href="{{ route('pa.products.index') }}"
                                    class="{{ $baseSubLinkClasses }} {{ request()->routeIs('pa.products.index') ? 'active' : '' }}">
                                    Data Produk
                                </a>
                            </li>
                            <li class="relative group/sub">
                                <a href="{{ route('pa.categories.index') }}"
                                    class="{{ $baseSubLinkClasses }} {{ request()->routeIs('pa.categories.index') ? 'active' : '' }}">
                                    Kategori
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="#" class="{{ $baseLinkClasses }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-user-3-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Customer
                        </span>
                    </a>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="#"
                        class="dropdown-button top-layer {{ $baseLinkClasses }} peer/dp-btn {{ request()->routeIs('pa.orders.*') ? 'active' : '' }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-shopping-cart-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Order
                        </span>
                    </a>
                    <div class="{{ $baseDropdownContentClasses }}">
                        <ul class="text-[14px] pl-1.5 group-data-[sidebar-size=sm]:pl-0">
                            <li class="relative group/sub">
                                <a href="{{ route('pa.orders.pending') }}"
                                    class="{{ $baseSubLinkClasses }} {{ request()->routeIs('pa.orders.pending') ? 'active' : '' }}">
                                    Order Konfirmasi
                                </a>
                            </li>
                            <li class="relative group/sub">
                                <a href="{{ route('pa.orders.history') }}" class="{{ $baseSubLinkClasses }}">
                                    Riwayat Order
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="{{ route('pa.banks.index') }}"
                        class="{{ $baseLinkClasses }}{{ request()->routeIs('pa.banks.index') ? 'active' : '' }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-bank-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Bank
                        </span>
                    </a>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="{{ route('pa.orders.daily') }}" class="{{ $baseLinkClasses }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-calendar-event-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Laporan Harian
                        </span>
                    </a>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="{{ route('pa.orders.monthly') }}" class="{{ $baseLinkClasses }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-calendar-check-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Laporan Bulanan
                        </span>
                    </a>
                </li>
                <li
                    class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                    <a href="#" class="{{ $baseLinkClasses }}">
                        <span
                            class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                            <i class="ri-lock-line group/menu-link:[&.active]:text-white"></i>
                        </span>
                        <span
                            class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                            Ganti Password
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Logout Link -->
    <div class="mt-auto px-7 py-6 group-data-[sidebar-size=sm]:px-2">
        <a href="#"
            class="flex-center-between text-gray-500 dark:text-dark-text font-semibold leading-none bg-gray-200 dark:bg-[#090927] dark:group-data-[sidebar-size=sm]:bg-dark-card-shade rounded-[10px] px-6 py-4 group-data-[sidebar-size=sm]:p-[12px_8px] group-data-[sidebar-size=sm]:justify-center dk-theme-card-square"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="group-data-[sidebar-size=sm]:hidden block">Logout</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path
                    d="M6.66645 15.3328C6.66645 15.5096 6.59621 15.6792 6.47119 15.8042C6.34617 15.9292 6.17661 15.9995 5.9998 15.9995H1.33329C0.979679 15.9995 0.640552 15.859 0.390511 15.609C0.140471 15.3589 0 15.0198 0 14.6662V1.33329C0 0.979679 0.140471 0.640552 0.390511 0.390511C0.640552 0.140471 0.979679 0 1.33329 0H5.9998C6.17661 0 6.34617 0.0702357 6.47119 0.195256C6.59621 0.320276 6.66645 0.48984 6.66645 0.666645C6.66645 0.84345 6.59621 1.01301 6.47119 1.13803C6.34617 1.26305 6.17661 1.33329 5.9998 1.33329H1.33329V14.6662H5.9998C6.17661 14.6662 6.34617 14.7364 6.47119 14.8614C6.59621 14.9865 6.66645 15.156 6.66645 15.3328ZM15.8045 8.47139L12.4713 11.8046C12.378 11.898 12.2592 11.9615 12.1298 11.9873C12.0004 12.0131 11.8663 11.9999 11.7444 11.9494C11.6225 11.8989 11.5184 11.8133 11.4451 11.7036C11.3719 11.5939 11.3329 11.4649 11.333 11.333V8.66638H5.9998C5.823 8.66638 5.65343 8.59615 5.52841 8.47113C5.40339 8.34611 5.33316 8.17654 5.33316 7.99974C5.33316 7.82293 5.40339 7.65337 5.52841 7.52835C5.65343 7.40333 5.823 7.33309 5.9998 7.33309H11.333V4.66651C11.3329 4.53459 11.3719 4.4056 11.4451 4.29587C11.5184 4.18615 11.6225 4.10062 11.7444 4.05012C11.8663 3.99962 12.0004 3.98642 12.1298 4.01218C12.2592 4.03795 12.378 4.10152 12.4713 4.19486L15.8045 7.52809C15.8665 7.59 15.9156 7.66352 15.9492 7.74445C15.9827 7.82538 16 7.91213 16 7.99974C16 8.08735 15.9827 8.17409 15.9492 8.25502C15.9156 8.33595 15.8665 8.40948 15.8045 8.47139ZM14.3879 7.99974L12.6663 6.27563V9.72385L14.3879 7.99974Z"
                    fill="currentColor" />
            </svg>
        </a>

        <form id="logout-form" action="{{ route('pa.logout') }}" method="POST" class="hidden">
            @csrf </form>
    </div>
</div>
