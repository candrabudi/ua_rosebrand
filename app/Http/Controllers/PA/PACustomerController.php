<?php

namespace App\Http\Controllers\PA;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class PACustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['user', 'addresses' => function ($q) {
            $q->where('is_default', true);
        }])
            ->when($request->search, function ($query) use ($request) {
                $query->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('username', 'like', '%' . $request->search . '%');
                    });
            })
            ->paginate(10);

        return view('pa.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::with([
            'user',
            'addresses',
            'orders.orderItems.product',
            'orders.payment'
        ])->findOrFail($id);

        $orders = $customer->orders;

        // Statistik
        $totalSpending = $orders->where('status', 'completed')->flatMap->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $stats = [
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'cancelled')->count(),
            'shipped'   => $orders->where('status', 'shipped')->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'paid'      => $orders->where('status', 'paid')->count(),
            'total_spending' => $totalSpending,
        ];

        return view('pa.customers.show', compact('customer', 'stats'));
    }


    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('pa.customers.index')->with('success', 'Customer berhasil dihapus.');
    }
}
