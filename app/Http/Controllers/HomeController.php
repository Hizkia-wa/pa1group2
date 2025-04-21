<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch best seller products (limited to 4)
        $bestSellerProducts = Product::where('is_best_seller', 1)
                                ->orderBy('created_at', 'desc')
                                ->take(4)
                                ->get();
        
        // Fetch latest testimonials/reviews (limited to 6)
        $testimonials = Review::orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();
        
                            return view('users.home', compact('bestSellerProducts', 'testimonials'));
                            }
}