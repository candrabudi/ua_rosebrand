@extends('pa.layouts.app')

@section('content')
    <div class="bg-white dark:bg-dark-card shadow-sm rounded-lg p-6 mb-6">
        <h3 class="text-2xl font-semibold mb-1">Detail Customer</h3>
        <p class="text-gray-500 text-sm">Semua informasi penting tentang pelanggan & riwayat pesanan</p>
    </div>

    {{-- Statistik Ringkasan --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        @foreach ([
            'Total Pengeluaran' => ['amount' => $stats['total_spending'], 'color' => 'text-primary'],
            'Order Berhasil' => ['amount' => $stats['completed'], 'color' => 'text-green-600'],
            'Order Dibatalkan' => ['amount' => $stats['cancelled'], 'color' => 'text-red-600'],
            'Order Dikirim' => ['amount' => $stats['shipped'], 'color' => 'text-yellow-500'],
            'Order Pending' => ['amount' => $stats['pending'], 'color' => 'text-gray-600'],
            'Order Lunas' => ['amount' => $stats['paid'], 'color' => 'text-blue-600'],
        ] as $label => $data)
            <div class="bg-white dark:bg-dark-card p-4 rounded-lg shadow-sm text-center">
                <div class="text-sm text-gray-500 mb-1">{{ $label }}</div>
                <div class="text-xl font-bold {{ $data['color'] }}">
                    {{ $label == 'Total Pengeluaran' ? 'Rp ' . number_format($data['amount'], 0, ',', '.') : $data['amount'] }}
                </div>
            </div>
        @endforeach
    </div>

    {{-- Informasi Customer --}}
    <div class="bg-white dark:bg-dark-card shadow-sm rounded-lg p-6 mb-6">
        <h4 class="text-lg font-semibold mb-3">Informasi Umum</h4>
        <ul class="text-sm text-gray-700 dark:text-gray-200 space-y-1">
            <li><strong>Nama:</strong> {{ $customer->full_name }}</li>
            <li><strong>Username:</strong> {{ $customer->user->username }}</li>
            <li><strong>Nomor HP:</strong> {{ $customer->phone_number }}</li>
        </ul>
    </div>

    {{-- Alamat --}}
    <div class="bg-white dark:bg-dark-card shadow-sm rounded-lg p-6 mb-6">
        <h4 class="text-lg font-semibold mb-3">Alamat Pengiriman</h4>
        @if ($customer->addresses->isEmpty())
            <p class="text-sm text-gray-500">Belum ada alamat.</p>
        @else
            <ul class="space-y-3 text-sm">
                @foreach ($customer->addresses as $addr)
                    <li class="border p-4 rounded bg-gray-50 dark:bg-dark-card">
                        <div class="flex justify-between items-center mb-1">
                            <strong>{{ $addr->label }}</strong>
                            @if ($addr->is_default)
                                <span class="text-xs text-green-600 font-medium">(Default)</span>
                            @endif
                        </div>
                        <div>{{ $addr->recipient_name }} - {{ $addr->phone_number }}</div>
                        <div>{{ $addr->full_address }}</div>
                        <div class="text-xs text-gray-400">
                            {{ $addr->district }}, {{ $addr->city }}, {{ $addr->province }}
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Riwayat Pesanan --}}
    <div class="bg-white dark:bg-dark-card shadow-sm rounded-lg p-6" style="margin-bottom: 20px;">
        <h4 class="text-lg font-semibold mb-3">Riwayat Order</h4>
        @if ($customer->orders->isEmpty())
            <p class="text-sm text-gray-500">Belum ada order.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-dark-border">
                <table class="table-auto w-full text-sm text-gray-700 dark:text-gray-200">
                    <thead class="bg-gray-100 dark:bg-dark-card">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium">Tanggal</th>
                            <th class="px-4 py-2 text-left font-medium">Metode</th>
                            <th class="px-4 py-2 text-left font-medium">Status</th>
                            <th class="px-4 py-2 text-right font-medium">Total</th>
                            <th class="px-4 py-2 text-left font-medium">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->orders as $order)
                            @php
                                $badge =
                                    [
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'shipped' => 'bg-yellow-100 text-yellow-800',
                                        'pending' => 'bg-gray-100 text-gray-800',
                                        'paid' => 'bg-blue-100 text-blue-800',
                                    ][$order->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-dark-hover">
                                <td class="px-4 py-3">{{ $order->ordered_at->format('d M Y') }}</td>
                                <td class="px-4 py-3 uppercase">{{ $order->payment_method }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $badge }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    Rp
                                    {{ number_format($order->orderItems->sum(fn($item) => $item->quantity * $item->price), 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-xs">{{ $order->address->full_address ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
