<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UADashboardController extends Controller
{
    public function index()
    {
        $customer = Auth::user()->customer;

        $defaultAddress = $customer->addresses()->where('is_default', true)->first();

        $recentOrders = $customer->orders()
            ->with(['orderItems.product'])
            ->latest('ordered_at')
            ->take(2)
            ->get();

        $totalOrders = $customer->orders()->count();

        $totalCartItems = $customer->carts()->count();

        $totalSpent = $customer->orders()
            ->with('orderItems')
            ->get()
            ->flatMap->orderItems
            ->sum(function ($item) {
                return $item->quantity * $item->price;
            });

        $hasAddress = $customer->addresses()->exists();

        return view('ua.dashboard.index', compact(
            'customer',
            'defaultAddress',
            'recentOrders',
            'totalOrders',
            'totalCartItems',
            'totalSpent',
            'hasAddress'
        ));
    }
}
