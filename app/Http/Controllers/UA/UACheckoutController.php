<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;

class UACheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
        $addresses = $customer->addresses ?? [];
        $defaultAddress = $addresses->where('is_default', true)->first();
        $cartItems = Cart::with('product')->where('customer_id', $customer->id)->get();
        $banks = Bank::all();

        return view('ua.checkout.index', compact('customer', 'addresses', 'defaultAddress', 'cartItems', 'banks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:customer_addresses,id',
            'payment_method' => 'required|in:cod,transfer',
            'bank_id' => 'required_if:payment_method,transfer|nullable|exists:banks,id',
        ]);

        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->firstOrFail();

        $cartItems = Cart::with('product')->where('customer_id', $customer->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong.');
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        $order = $customer->orders()->create([
            'address_id'     => $request->address_id,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
            'ordered_at'     => now(),
        ]);

        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        $order->payment()->create([
            'bank_id' => $request->payment_method === 'transfer' ? $request->bank_id : null,
            'method'  => $request->payment_method,
            'paid_at' => $request->payment_method === 'cod' ? now() : null,
        ]);

        Cart::where('customer_id', $customer->id)->delete();

        return redirect()->route('ua.orders.index', $order->id)->with('success', 'Pesanan berhasil dibuat.');
    }
}
