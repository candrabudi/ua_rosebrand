<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UAOrderController extends Controller
{
    public function index()
    {
        $customer = Auth::user()->customer;
        $orders = Order::with(['orderItems.product', 'address', 'payment'])
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();

        return view('ua.dashboard.order', compact('orders', 'customer'));
    }
}
