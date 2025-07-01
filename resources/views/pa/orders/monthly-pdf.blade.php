<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Order Tahunan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary-card { display: inline-block; width: 30%; margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .summary-title { font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>

    <h2>Laporan Order Tahunan - {{ $year }}</h2>

    <div class="summary">
        <div class="summary-card"><div class="summary-title">Total Order</div>{{ $summary['semua'] }}</div>
        <div class="summary-card"><div class="summary-title">Pending</div>{{ $summary['pending'] }}</div>
        <div class="summary-card"><div class="summary-title">Dibayar</div>{{ $summary['paid'] }}</div>
        <div class="summary-card"><div class="summary-title">Dikirim</div>{{ $summary['shipped'] }}</div>
        <div class="summary-card"><div class="summary-title">Selesai</div>{{ $summary['completed'] }}</div>
        <div class="summary-card"><div class="summary-title">Dibatalkan</div>{{ $summary['cancelled'] }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Metode</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $order->customer->full_name }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->ordered_at->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ strtoupper($order->payment_method) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada order di tahun ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
