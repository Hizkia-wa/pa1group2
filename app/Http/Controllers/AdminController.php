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


    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('status', 'Password berhasil diubah!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
