<?php

namespace App\Http\Controllers\PA;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PAOrderController extends Controller
{
    public function history(Request $request)
    {
        $query = Order::with([
            'customer',
            'address',
            'orderItems:id,order_id,product_id,price,quantity',
            'orderItems.product:id,name,unit_name',
        ])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('ordered_at', [
                Carbon::parse($request->from)->startOfDay(),
                Carbon::parse($request->to)->endOfDay(),
            ]);
        }

        $orders = $query->paginate(10);

        return view('pa.orders.history', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::with([
            'customer',
            'address',
            'orderItems:id,order_id,product_id,price,quantity',
            'orderItems.product:id,name,unit_name'
        ])
            ->whereIn('status', ['pending', 'paid'])
            ->latest()
            ->paginate(10);

        return view('pa.orders.pending', compact('orders'));
    }


    public function daily(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : now();
        $query = Order::with('customer')->whereDate('ordered_at', $date);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $totals = [
            'semua'     => $orders->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'paid'      => $orders->where('status', 'paid')->count(),
            'shipped'   => $orders->where('status', 'shipped')->count(),
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
        ];

        return view('pa.orders.daily', compact('orders', 'totals'));
    }

    public function exportDailyPdf(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : now();

        $query = Order::with('customer')->whereDate('ordered_at', $date);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $summary = [
            'semua'     => $orders->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'paid'      => $orders->where('status', 'paid')->count(),
            'shipped'   => $orders->where('status', 'shipped')->count(),
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
        ];

        $pdf = PDF::loadView('pa.orders.daily-pdf', compact('orders', 'summary', 'date'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("laporan-harian-{$date->format('Y-m-d')}.pdf");
    }


    public function monthlyReport(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $query = Order::with('customer')
            ->whereYear('ordered_at', $year)
            ->whereMonth('ordered_at', $month);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $summary = [
            'semua'     => $orders->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'paid'      => $orders->where('status', 'paid')->count(),
            'shipped'   => $orders->where('status', 'shipped')->count(),
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
        ];

        return view('pa.orders.monthly', compact('orders', 'summary', 'year', 'month'));
    }

    public function exportMonthlyPdf(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $query = Order::with('customer')
            ->whereYear('ordered_at', $year)
            ->whereMonth('ordered_at', $month);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $summary = [
            'semua'     => $orders->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'paid'      => $orders->where('status', 'paid')->count(),
            'shipped'   => $orders->where('status', 'shipped')->count(),
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
        ];

        $pdf = PDF::loadView('pa.orders.monthly-pdf', compact('orders', 'summary', 'year', 'month'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("laporan-bulanan-{$year}-{$month}.pdf");
    }

    public function show(Order $order)
    {
        $order->load([
            'customer.user',
            'address',
            'orderItems.product',
            'payment.bank'
        ]);

        return view('pa.orders.detail', compact('order'));
    }

    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'action' => 'required|in:paid,shipped,completed,cancelled',
        ]);

        $order = Order::where('id', $orderId)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.',
            ], 404);
        }

        $order->status = $request->action;
        $order->save();

        if ($request->action == 'paid') {
            $payment = Payment::where('order_id', $order->id)->first();
            if ($payment && $payment->method === 'transfer') {
                $payment->paid_at = now();
                $payment->save();
            }
        }

        $statusTranslations = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'shipped' => 'Sedang Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        $translatedStatus = $statusTranslations[$order->status] ?? ucfirst($order->status);

        return response()->json([
            'success' => true,
            'message' => "Status pesanan #{$order->id} berhasil diperbarui menjadi '{$translatedStatus}'.",
            'order_id' => $order->id,
            'new_status' => $order->status,
            'status_label' => $translatedStatus,
        ]);
    }




    public function confirmPayment(Request $request, Payment $payment)
    {
        if ($payment->order->status !== 'pending' || $payment->method !== 'transfer' ||  $payment->paid_at) {
            return response()->json(['success' => false, 'message' => 'Payment cannot be confirmed in its current state.'], 400);
        }

        $payment->paid_at = now();
        $payment->save();

        $payment->order->status = 'paid';
        $payment->order->save();

        return response()->json(['success' => true, 'message' => 'Pembayaran berhasil dikonfirmasi!', 'order_status' => $payment->order->status]);
    }
}
