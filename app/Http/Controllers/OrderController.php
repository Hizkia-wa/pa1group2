<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.Orders', compact('orders'));
    }
        public function store(Request $request)
    {
        $request->validate([
            'ProductId' => 'required|exists:products,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'size' => 'required|string',
            'Quantity' => 'required|integer|min:1',
        ]);

        Order::create([
            'ProductId' => $request->ProductId,
            'CustomerName' => $request->name,
            'Email' => $request->email,
            'Phone' => $request->phone,
            'City' => $request->city,
            'District' => $request->district,
            'Address' => $request->address,
            'PostalCode' => $request->postal_code,
            'Size' => $request->size,
            'Quantity' => $request->Quantity,
        ]);

        return redirect()->back()->with('success', 'Pesanan Anda telah berhasil dikirim!');
    }

    public function riwayat()
    {
        $orders = Order::onlyTrashed()->get();
        return view('admin.riwayatorder', compact('orders'));
    }
}
