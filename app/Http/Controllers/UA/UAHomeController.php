<?php

namespace App\Http\Controllers\UA;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UAHomeController extends Controller
{
    public function index()
    {
        $topRosebrandProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id', 'products.category_id')
            ->orderByDesc('total_sold')
            ->take(8)
            ->get();

        $categories = Category::with(['products'])->take(3)->get();
        return view('ua.home.index', compact('topRosebrandProducts', 'categories'));
    }


    public function products(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'alphabetical':
                    $query->orderBy('name', 'asc');
                    break;
            }
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('ua.home.products', compact('products', 'categories'));
    }
}
