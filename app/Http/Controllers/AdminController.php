<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Review;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahProduk = product::count();
        $jumlahCustomer = customer::count();
        $jumlahOrder = order::count();
        $jumlahReview = review::count();

        return view('admin.homepage', compact('jumlahProduk', 'jumlahCustomer', 'jumlahOrder', 'jumlahReview'));
    }

}
