@extends('pa.layouts.app')

@section('title', 'Detail Order')

@section('content')
    <div class="card p-0">
        <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
            <h3 class="text-lg card-title leading-none">Detail Order <span
                    class="font-bold text-primary-600">#{{ $order->id }}</span></h3>
            <a href="{{ route('pa.orders.pending') }}" class="btn b-light btn-secondary-light dk-theme-card-square">
                <i class="ri-arrow-left-line text-inherit mr-1"></i>
                <span>Kembali ke Daftar Order</span>
            </a>
        </div>

        <div class="p-6 pb-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="card card-body p-6">
                    <h4
                        class="text-base font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-100 dark:border-dark-border-three">
                        Informasi Order</h4>
                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <p class="flex justify-between items-center">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Status Order:</span>
                            <span
                                class="capitalize
                                {{ $order->status === 'pending'
                                    ? 'badge badge-warning-light'
                                    : ($order->status === 'paid'
                                        ? 'badge badge-success-light'
                                        : ($order->status === 'shipped'
                                            ? 'badge badge-info-light'
                                            : ($order->status === 'completed'
                                                ? 'badge badge-primary-light'
                                                : ($order->status === 'cancelled'
                                                    ? 'badge badge-danger-light'
                                                    : 'badge badge-disable-light')))) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p class="flex justify-between items-center">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Metode Pembayaran:</span>
                            <span class="capitalize font-semibold">{{ $order->payment_method }}</span>
                        </p>
                        <p class="flex justify-between items-center">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Tanggal Order:</span>
                            <span
                                class="font-semibold">{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, H:i') }}</span>
                        </p>
                        <p
                            class="flex justify-between items-center text-lg font-bold text-gray-900 dark:text-white pt-4 mt-3 border-t border-gray-100 dark:border-dark-border">
                            <span>Total Harga:</span>
                            <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </p>
                    </div>
                </div>

                <div class="card card-body p-6">
                    <h4
                        class="text-base font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-100 dark:border-dark-border-three">
                        Informasi Pelanggan</h4>
                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Nama Pelanggan:</span>
                            <span class="font-semibold">{{ $order->customer->full_name ?? '-' }}</span>
                        </p>
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Email (jika ada):</span>
                            <span class="font-semibold">{{ $order->customer->user->email ?? '-' }}</span>
                        </p>
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Nomor Telepon:</span>
                            <span class="font-semibold">{{ $order->customer->phone_number ?? '-' }}</span>
                        </p>
                    </div>
                </div>

                <div class="card card-body p-6">
                    <h4
                        class="text-base font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 border-gray-100 dark:border-dark-border-three">
                        Alamat Pengiriman</h4>
                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Nama Penerima:</span>
                            <span class="font-semibold">{{ $order->address->recipient_name ?? '-' }}</span>
                        </p>
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Nomor Telepon Penerima:</span>
                            <span class="font-semibold">{{ $order->address->phone_number ?? '-' }}</span>
                        </p>
                        <p class="flex justify-between items-start">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Alamat Lengkap:</span>
                            <span class="text-right max-w-sm ml-4 font-semibold">
                                {{ $order->address->full_address ?? '-' }},
                                {{ $order->address->district ?? '-' }},
                                {{ $order->address->city ?? '-' }},
                                {{ $order->address->province ?? '-' }}
                            </span>
                        </p>
                        <p class="flex justify-between">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Label Alamat:</span>
                            <span
                                class="badge badge-secondary-light font-semibold">{{ $order->address->label ?? '-' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-0 mt-6">
            <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
                <h4 class="text-base font-semibold text-gray-900 dark:text-white">Item Order</h4>
            </div>
            <div class="overflow-x-auto">
                <table
                    class="table-auto border-collapse w-full whitespace-nowrap text-left text-gray-500 dark:text-dark-text font-medium">
                    <thead>
                        <tr class="text-primary-500">
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">#</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Produk</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two">Harga Satuan</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two text-center">Jumlah</th>
                            <th class="p-6 py-4 bg-[#F2F4F9] dark:bg-dark-card-two text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-dark-border-three">
                        @forelse ($order->orderItems as $i => $item)
                            <tr>
                                <td class="p-6 py-4">{{ $i + 1 }}</td>
                                <td class="p-6 py-4 font-semibold text-gray-900 dark:text-dark-text">
                                    {{ $item->product->name ?? '-' }}</td>
                                <td class="p-6 py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="p-6 py-4 text-center">{{ $item->quantity }}
                                    {{ $item->product->unit_name ?? '' }}</td>
                                <td class="p-6 py-4 text-right">Rp
                                    {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 py-4 text-center text-gray-500 dark:text-dark-text">Tidak ada
                                    item dalam order ini.</td>
                            </tr>
                        @endforelse
                        @if ($order->orderItems->isNotEmpty())
                            <tr class="bg-[#F2F4F9] dark:bg-dark-card-two font-bold text-gray-900 dark:text-white">
                                <td colspan="4" class="p-6 py-4 text-right">Total Keseluruhan:</td>
                                <td class="p-6 py-4 text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card p-0 mt-6">
            <div class="flex-center-between p-6 pb-4 border-b border-gray-200 dark:border-dark-border">
                <h4 class="text-base font-semibold text-gray-900 dark:text-white">Detail Pembayaran</h4>
            </div>
            <div class="p-6">
                @if ($order->payment)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <p class="flex justify-between col-span-full md:col-span-1">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Metode Pembayaran:</span>
                            <span class="capitalize font-semibold">{{ $order->payment->method }}</span>
                        </p>
                        @if ($order->payment->method === 'transfer')
                            <p class="flex justify-between col-span-full md:col-span-1">
                                <span class="font-medium text-gray-800 dark:text-gray-200">Nama Bank Tujuan:</span>
                                <span class="font-semibold">{{ $order->payment->bank->bank_name ?? '-' }}</span>
                            </p>
                            <p class="flex justify-between col-span-full md:col-span-1">
                                <span class="font-medium text-gray-800 dark:text-gray-200">Nama Akun Tujuan:</span>
                                <span class="font-semibold">{{ $order->payment->bank->account_name ?? '-' }}</span>
                            </p>
                            <p class="flex justify-between col-span-full md:col-span-1">
                                <span class="font-medium text-gray-800 dark:text-gray-200">Nomor Rekening Tujuan:</span>
                                <span class="font-semibold">{{ $order->payment->bank->account_number ?? '-' }}</span>
                            </p>
                            <p class="flex justify-between items-center col-span-full md:col-span-1">
                                <span class="font-medium text-gray-800 dark:text-gray-200">Bukti Transfer:</span>
                                @if ($order->payment->proof)
                                    <a href="{{ asset('storage/' . $order->payment->proof) }}" target="_blank"
                                        class="text-primary-500 hover:underline flex items-center gap-1">
                                        Lihat Bukti <i class="ri-external-link-line text-xs"></i>
                                    </a>
                                @else
                                    <span class="text-gray-500">Belum ada bukti transfer</span>
                                @endif
                            </p>
                        @endif
                        @if ($order->payment->method === 'transfer')
                            <p class="flex justify-between col-span-full md:col-span-1">
                                <span class="font-medium text-gray-800 dark:text-gray-200">Status Pembayaran:</span>
                                @if ($order->status === 'paid')
                                    <span class="badge badge-success-light font-semibold">Sudah Dibayar</span>
                                @else
                                    <span class="badge badge-warning-light font-semibold">Menunggu Konfirmasi
                                        Pembayaran</span>
                                @endif
                            </p>
                        @endif
                        <p class="flex justify-between col-span-full md:col-span-1">
                            <span class="font-medium text-gray-800 dark:text-gray-200">Tanggal Pembayaran:</span>
                            <span
                                class="font-semibold">{{ $order->payment->paid_at ? \Carbon\Carbon::parse($order->payment->paid_at)->format('d M Y, H:i') : '-' }}</span>
                        </p>
                    </div>

                    @if (
                        $order->status === 'pending' &&
                            $order->payment->method === 'transfer' &&
                            $order->payment->proof &&
                            !$order->payment->paid_at)
                        <div class="text-right mt-6 pt-4 border-t border-gray-100 dark:border-dark-border">
                            <button type="button" class="btn btn-primary action-btn" data-action="paid"
                                data-order-id="{{ $order->id }}">
                                <i class="ri-check-line mr-1"></i> Konfirmasi Pembayaran
                            </button>
                        </div>
                    @endif
                @else
                    <p class="text-gray-500 dark:text-gray-400">Belum ada informasi pembayaran untuk order ini.</p>
                @endif
            </div>
        </div>

        <div class="card p-6 mt-6 text-right">
            @if (
                ($order->status === 'pending' && $order->payment_method === 'cod') ||
                    ($order->status === 'paid' && $order->payment_method === 'transfer'))
                <button type="button" class="btn btn-primary action-btn" data-action="shipped"
                    data-order-id="{{ $order->id }}">
                    <i class="ri-truck-line mr-1"></i> Kirim Order
                </button>
            @elseif ($order->status === 'shipped')
                <button type="button" class="btn btn-success action-btn" data-action="completed"
                    data-order-id="{{ $order->id }}">
                    <i class="ri-check-double-line mr-1"></i> Selesaikan Order
                </button>
            @else
                <span class="text-gray-500 text-sm">Tidak ada aksi pengiriman/penyelesaian yang tersedia pada status
                    ini.</span>
            @endif

            @if (!in_array($order->status, ['completed', 'cancelled', 'shipped']))
                <button type="button" class="btn btn-outline-danger ml-2 action-btn" data-action="rejected"
                    data-order-id="{{ $order->id }}">
                    <i class="ri-close-circle-line mr-1"></i> Batalkan Order
                </button>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const actionButtons = document.querySelectorAll('.action-btn');

            async function performAction(orderId, action) {
                try {
                    const response = await fetch(`{{ url('pa/orders') }}/${orderId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            action: action
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message,
                            confirmButtonText: 'Oke'
                        });
                    }
                } catch (error) {
                    console.error('Fetch Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Jaringan!',
                        text: 'Terjadi kesalahan saat berkomunikasi dengan server.',
                        confirmButtonText: 'Oke'
                    });
                }
            }

            actionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    const action = this.dataset.action;
                    let title = '';
                    let text = '';
                    let icon = 'question';
                    let confirmButtonColor = '#3085d6';
                    switch (action) {
                        case 'pending':
                            title = 'Konfirmasi Pembayaran';
                            text =
                                `Apakah Anda yakin ingin mengkonfirmasi pembayaran untuk Order #${orderId}?`;
                            break;
                        case 'shipped':
                            title = 'Konfirmasi Pengiriman Order';
                            text =
                                `Apakah Anda yakin ingin mengubah status Order #${orderId} menjadi DIKIRIM?`;
                            break;
                        case 'completed':
                            title = 'Selesaikan Order';
                            text = `Apakah Anda yakin Order #${orderId} telah SELESAI?`;
                            icon = 'info';
                            confirmButtonColor = '#28a745';
                            break;
                        case 'rejected':
                            title = 'Batalkan Order';
                            text =
                                `Apakah Anda yakin ingin membatalkan Order #${orderId}? Aksi ini tidak dapat dibatalkan.`;
                            icon = 'warning';
                            confirmButtonColor = '#dc3545';
                            break;
                        default:
                            title = 'Konfirmasi Aksi';
                            text =
                                `Apakah Anda yakin ingin melakukan aksi ini untuk Order #${orderId}?`;
                    }

                    Swal.fire({
                        title: title,
                        html: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: confirmButtonColor,
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Konfirmasi!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            performAction(orderId, action);
                        }
                    });
                });
            });
        });
    </script>
@endpush
