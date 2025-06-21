<?php

namespace App\Http\Controllers\PA;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class PADashboardController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->input('date_range');

        $startDate = $range
            ? explode(' - ', $range)[0]
            : now()->startOfMonth()->toDateString();

        $endDate = $range
            ? explode(' - ', $range)[1]
            : now()->endOfMonth()->toDateString();

        $totalProducts = Product::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalCategories = Category::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalCustomers = Customer::whereBetween('created_at', [$startDate, $endDate])->count();

        $orders = Order::whereBetween('ordered_at', [$startDate, $endDate])->get();

        $completedOrderIds = $orders->where('status', 'completed')->pluck('id');

        $totalProfit = OrderItem::whereIn('order_id', $completedOrderIds)
            ->selectRaw('SUM(price * quantity) as total')
            ->value('total') ?? 0;

        $successfulOrders = $orders->where('status', 'completed')->count();
        $failedOrders = $orders->where('status', 'cancelled')->count();
        $totalOrders = $orders->count();

        $totalDays = \Carbon\Carbon::parse($endDate)->diffInDays(\Carbon\Carbon::parse($startDate)) + 1;
        $averageOrderPerDay = round($totalOrders / max($totalDays, 1), 1);

        return view('pa.dashboard.index', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalProfit' => $totalProfit,
            'successfulOrders' => $successfulOrders,
            'failedOrders' => $failedOrders,
            'averageOrderPerDay' => $averageOrderPerDay,
            'dateRange' => "$startDate - $endDate",
        ]);
    }
}
