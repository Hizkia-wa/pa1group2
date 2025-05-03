<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    // Untuk pengunjung (guest)
    public function homeGuest()
    {
        $bestSellerProducts = Product::where('IsBestSeller', 1)
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();

        $testimonials = Review::orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();

        return view('users.home', compact('bestSellerProducts', 'testimonials'));
    }

    // Untuk customer (login)
    public function homeCustomer()
    {
        $bestSellerProducts = Product::where('IsBestSeller', 1)
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();

        $testimonials = Review::orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();

        return view('customer.home', compact('bestSellerProducts', 'testimonials'));
    }

    // Untuk admin (jika ada akses manual)
    public function homeAdmin()
    {
        $bestSellerProducts = Product::where('IsBestSeller', 1)
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();

        $testimonials = Review::orderBy('created_at', 'desc')
                            ->take(10)
                            ->get();

        return view('admin.users.home', compact('bestSellerProducts', 'testimonials'));
    }
}
