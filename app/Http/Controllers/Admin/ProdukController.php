<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        return view('admin.productpage', compact('products'));
    }


    public function bestSellers()
    {
        $products = Product::withCount('orderItems')
                    ->orderBy('order_items_count', 'desc')
                    ->take(10)
                    ->get();

        return view('admin.bestproductpage', compact('products'));
    }
}
