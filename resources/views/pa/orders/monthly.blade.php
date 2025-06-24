@extends('pa.layouts.app')

@section('title', 'Laporan Tahunan Order')

@section('content')
    <div class="card p-0">
        <div class="p-6 pb-4 border-b border-gray-200 dark:border-dark-border flex items-center justify-between">
            <h3 class="text-xl font-semibold text-heading">Laporan Tahunan Order</h3>
            <a href="{{ route('pa.report.monthly.export', request()->query()) }}" class="btn b-solid btn-primary-solid">
                <i class="ri-download-2-line mr-1"></i> Export PDF
            </a>
        </div>

        <div class="p-6">
            <form method="GET" action="{{ route('pa.report.monthly') }}"
                class="w-full bg-white dark:bg-dark-card p-4 rounded-xl shadow-sm mb-4 border border-gray-200 dark:border-dark-border">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    {{-- Status --}}
                    <div class="space-y-1">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" class="form-input form-select w-full h-11">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>

                    {{-- Bulan --}}
                    <div class="space-y-1">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">Bulan</label>
                        <select name="month" class="form-input form-select w-full h-11">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}"
                                    {{ request('month', now()->month) == $m ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tahun --}}
                    <div class="space-y-1">
                        <label class="block text-sm text-gray-700 dark:text-gray-300">Tahun</label>
                        <input type="number" name="year" class="form-input form-input-sm w-full"
                            value="{{ request('year', now()->year) }}">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-end">
                        <button class="btn btn-sm btn-primary w-full">Terapkan</button>
                    </div>
                </div>
            </form>


            {{-- Ringkasan --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                @foreach ($summary as $label => $value)
                    <div class="p-4 bg-gray-50 dark:bg-dark-card rounded shadow-sm text-center">
                        <p class="text-sm text-gray-500">{{ ucfirst($label) }}</p>
                        <p class="text-lg font-semibold">{{ $value }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left text-sm">
                    <thead class="bg-gray-100 dark:bg-dark-card">
                        <tr>
                            <th class="p-4">#</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Metode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $i => $order)
                            <tr class="border-b border-gray-200 dark:border-dark-border">
                                <td class="p-4">{{ $i + 1 }}</td>
                                <td class="p-4">{{ $order->customer->full_name }}</td>
                                <td class="p-4 capitalize">{{ $order->status }}</td>
                                <td class="p-4">{{ $order->ordered_at->format('d M Y') }}</td>
                                <td class="p-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="p-4 uppercase">{{ $order->payment_method }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">Tidak ada order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
