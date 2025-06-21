<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UACartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customer = Auth::user()->customer;
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 403);
        }

        Cart::updateOrCreate(
            ['customer_id' => $customer->id, 'product_id' => $request->product_id],
            ['quantity' => DB::raw("quantity + {$request->quantity}")]
        );

        return response()->json([
            'success' => true,
        ]);
    }

    public function cartCount()
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('customer_id', $customer->id)->count();

        return response()->json(['count' => $count]);
    }

    public function getCartItems(Request $request)
    {
        $customerId = auth()->user()->customer->id;
        $carts = Cart::with('product')
            ->where('customer_id', $customerId)
            ->get();

        $total = 0;
        $saving = 0;
        $items = [];

        foreach ($carts as $cart) {
            $product = $cart->product;
            $discountPrice = $product->price; // contoh: harga akhir
            $originalPrice = $product->price * 1.2; // asumsi diskon 20%

            $items[] = [
                'id'         => $cart->id,
                'product_id' => $product->id,
                'name'       => $product->name,
                'image'      => asset('storage/' . $product->image),
                'quantity'   => $cart->quantity,
                'unit'       => $product->unit_name,
                'price'      => $discountPrice,
                'original'   => $originalPrice,
                'subtotal'   => $discountPrice * $cart->quantity,
            ];

            $total  += $discountPrice * $cart->quantity;
            $saving += ($originalPrice - $discountPrice) * $cart->quantity;
        }

        return response()->json([
            'items'       => $items,
            'total'       => $total,
            'saving'      => $saving,
            'total_items' => count($carts),
        ]);
    }


    public function deleteItem($id)
    {
        $customer = Auth::user()->customer;

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $cart = Cart::where('id', $id)->where('customer_id', $customer->id)->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }

        $cart->delete();

        return response()->json(['success' => true, 'message' => 'Item deleted']);
    }
}
