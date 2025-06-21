@extends('pa.layouts.app')

@section('title', 'Riwayat Order')

@section('content')
    <div class="card p-0">
        <div class="p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
            <h3 class="text-xl font-semibold text-heading">Riwayat Order</h3>
        </div>

        <div class="p-6">
            <form method="GET" action="{{ route('pa.orders.history') }}"
                class="w-full bg-white dark:bg-dark-card p-6 rounded-xl shadow-sm mb-6 border border-gray-200 dark:border-dark-border">
                <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                    {{-- Title --}}
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Filter Riwayat Order</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gunakan filter di bawah ini untuk menyaring data
                            order berdasarkan nama customer, status, dan tanggal pemesanan.</p>
                    </div>

                    {{-- Filters --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full">
                        {{-- Search --}}
                        <div class="relative">

                            <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Nama Customer</label>
                            <div class="relative">
                                <div class="sm:min-w-52 leading-none text-sm relative text-gray-900 dark:text-dark-text">
                                    <span class="absolute top-1/2 -translate-y-[40%] left-2.5">
                                        <i class="ri-search-line text-gray-900 dark:text-dark-text text-[14px]"></i>
                                    </span>
                                    <input type="search" name="search" placeholder="Search..." value="{{request('search')}}" class="form-input pl-8">
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Status Order</label>
                            <select name="status" class="form-input form-select h-10 py-0 w-full">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>

                        {{-- Date Range --}}
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Rentang Tanggal</label>
                            <input type="text" name="date_range" id="date-range" value="{{ request('date_range') }}"
                                class="form-input w-full h-10 py-2 rounded-md" placeholder="Pilih rentang tanggal">
                        </div>

                        {{-- Filter Button --}}
                        <div class="flex items-end">
                            <button type="submit" class="btn b-light btn-primary-light dk-theme-card-square w-full h-10">Terapkan Filter</button>
                        </div>
                    </div>
                </div>
            </form>


            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left text-sm">
                    <thead class="bg-gray-100 dark:bg-dark-card">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Tanggal Order</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Metode</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $i => $order)
                            <tr class="border-b border-gray-200 dark:border-dark-border">
                                <td class="p-4">{{ $i + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                <td class="p-4">{{ $order->customer->full_name }}</td>
                                <td class="p-4 capitalize">
                                    <span
                                        class="badge {{ match ($order->status) {
                                            'pending' => 'badge-warning-light',
                                            'paid' => 'badge-success-light',
                                            'shipped' => 'badge-secondary-light',
                                            'completed' => 'badge-success-light',
                                            'cancelled' => 'badge-danger-light',
                                            default => 'badge-disable-light',
                                        } }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4">{{ $order->ordered_at->format('d M Y H:i') }}</td>
                                <td class="p-4 font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-4 uppercase">{{ $order->payment_method }}</td>
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
                                <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan {{ $orders->firstItem() }} - {{ $orders->lastItem() }} dari {{ $orders->total() }} entri
                </div>
                <div class="flex gap-1">
                    @for ($page = 1; $page <= $orders->lastPage(); $page++)
                        <a href="{{ $orders->url($page) }}"
                            class="px-3 py-1 rounded-md text-sm {{ $page == $orders->currentPage() ? 'bg-primary-500 text-white' : 'bg-gray-100 dark:bg-dark-card text-gray-700 dark:text-dark-text' }}">
                            {{ $page }}
                        </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#date-range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                }
            });

            $('#date-range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endpush
