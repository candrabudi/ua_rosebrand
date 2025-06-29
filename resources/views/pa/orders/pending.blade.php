@extends('pa.layouts.app')

@section('title', 'Order List')

@section('content')
    <div class="card p-0">
        <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
            <h3 class="text-lg card-title leading-none">Daftar Order Pending & Belum Konfirmasi</h3>
        </div>

        <div class="p-6">
            <div class="flex-center-between">
                <div class="flex items-center gap-5">
                    <form method="GET" action="{{ route('pa.orders.pending') }}"
                        class="max-w-80 relative flex items-center gap-2">
                        <span class="absolute -translate-y-[40%] left-2.5" style="top: 20px;">
                            <i class="ri-search-line text-gray-900 dark:text-dark-text text-[14px]"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari order..."
                            class="form-input pl-[30px] w-full">
                        <button type="submit"
                            class="font-spline_sans text-sm px-1 text-gray-900 dark:text-dark-text flex-center gap-1.5">
                            <i class="ri-loop-right-line text-inherit text-sm"></i>
                            <span>Cari</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto mt-5">
                <table
                    class="table-auto border-collapse w-full whitespace-nowrap text-left text-gray-500 dark:text-dark-text font-medium">
                    <thead>
                        <tr class="text-primary-500">
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">#</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Customer</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Status</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Tanggal</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Total</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Pembayaran</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two w-10 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-dark-border-three">
                        @forelse ($orders as $i => $order)
                            <tr id="order-row-{{ $order->id }}">
                                <td class="p-6 py-4">{{ $i + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                <td class="p-6 py-4">{{ $order->customer->full_name ?? '-' }}</td>
                                <td class="p-6 py-4">
                                    @php
                                        $badgeClasses = [
                                            'pending' => 'badge badge-warning-light',
                                            'paid' => 'badge badge-success-light',
                                            'shipped' => 'badge badge-secondary-light',
                                            'completed' => 'badge badge-success-light',
                                            'cancelled' => 'badge badge-danger-light',
                                            'default' => 'badge badge-disable-light',
                                        ];

                                        $statusTranslations = [
                                            'pending' => 'Menunggu Konfirmasi',
                                            'paid' => 'Sudah Dibayar',
                                            'shipped' => 'Sedang Dikirim',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];
                                    @endphp
                                    <span class="capitalize {{ $badgeClasses[$order->status] ?? $badgeClasses['default'] }}"
                                        id="order-status-{{ $order->id }}">
                                        {{ $statusTranslations[$order->status] ?? ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td class="p-6 py-4 text-gray-600 dark:text-gray-400">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="p-6 py-4 font-medium">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="p-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <span class="capitalize font-semibold text-gray-700 dark:text-gray-200">
                                            {{ strtoupper($order->payment_method) }}
                                        </span>

                                        @if ($order->payment_method === 'transfer' && $order->payment && $order->payment->bank)
                                            <div class="text-sm text-gray-500 dark:text-gray-400 leading-snug">
                                                Bank: {{ $order->payment->bank->bank_name }}<br>
                                                No. Rek: {{ $order->payment->bank->account_number }}<br>
                                                a.n: {{ $order->payment->bank->account_name }}
                                            </div>
                                        @endif

                                        @if ($order->payment && $order->payment->paid_at && $order->payment_method === 'transfer')
                                            <div class="text-sm text-green-500 mt-1">
                                                Dibayar pada:
                                                {{ \Carbon\Carbon::parse($order->payment->paid_at)->format('d M Y H:i') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-6 py-4 text-center">
                                    <div class="flex items-center gap-2 justify-center">
                                        <a href="{{ route('pa.orders.show', $order->id) }}"
                                            class="btn-icon btn-secondary-icon-light size-7" title="Lihat Order">
                                            <i class="ri-eye-line text-inherit text-[13px]"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-6 py-4 text-center text-gray-500 dark:text-dark-text">
                                    Tidak ada data order.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <div class="flex-center-between mt-5">
                <div class="font-spline_sans text-sm text-gray-900 dark:text-dark-text">
                    Menampilkan {{ $orders->firstItem() }} hingga {{ $orders->lastItem() }} dari
                    {{ $orders->total() }} entri
                </div>
                <nav>
                    <ul class="flex items-center gap-1">
                        @if ($orders->onFirstPage())
                            <li>
                                <span
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-400 dark:text-gray-600 bg-gray-100 dark:bg-dark-card-two cursor-not-allowed">
                                    <i class="ri-arrow-left-s-line text-inherit"></i>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $orders->previousPageUrl() }}"
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text hover:bg-primary-500 hover:text-white dark:bg-dark-card-two">
                                    <i class="ri-arrow-left-s-line text-inherit"></i>
                                </a>
                            </li>
                        @endif

                        @foreach ($orders->links()->elements as $element)
                            @if (is_string($element))
                                <li>
                                    <span
                                        class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text">
                                        <i class="ri-more-fill text-inherit"></i>
                                    </span>
                                </li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <li>
                                        <a href="{{ $url }}"
                                            class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text {{ $page == $orders->currentPage() ? 'active bg-primary-500 text-white' : '' }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach

                        @if ($orders->hasMorePages())
                            <li>
                                <a href="{{ $orders->nextPageUrl() }}"
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-900 dark:text-dark-text hover:bg-primary-500 hover:text-white dark:bg-dark-card-two">
                                    <i class="ri-arrow-right-s-line text-inherit"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <span
                                    class="font-spline_sans font-medium flex-center size-8 rounded-50 text-gray-400 dark:text-gray-600 bg-gray-100 dark:bg-dark-card-two cursor-not-allowed">
                                    <i class="ri-arrow-right-s-line text-inherit"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
