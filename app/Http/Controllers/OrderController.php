<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::whereNotIn('OrderStatus', ['Selesai', 'Batal'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function ($item) {
            return $item->CustomerName 
                . '|' . $item->Email 
                . '|' . $item->Phone 
                . '|' . $item->created_at->format('Y-m-d H:i:s'); // waktu lengkap sampai detik
        });

    return view('admin.Orders', compact('orders'));
}
    
public function store(Request $request)
{
    try {
        // Validasi input yang diterima
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

        $product = Product::findOrFail($request->ProductId);

        if ($product->Quantity < $request->Quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi.',
            ], 400);
        }

        // Kurangi stok produk
        $product->decrement('Quantity', $request->Quantity);

        
        // Simpan pesanan ke database
        $order = Order::create([
            'ProductId'    => $request->ProductId,
            'CustomerName' => $request->name,
            'Email'        => $request->email,
            'Phone'        => $request->phone,
            'City'         => $request->city,
            'District'     => $request->district,
            'Address'      => $request->address,
            'PostalCode'   => $request->postal_code,
            'Size'         => $request->size,
            'Quantity'     => $request->Quantity,
            'total_price'  => $product->Price * $request->Quantity,
            'OrderStatus'  => 'Diproses',
        ]);

        // Mengembalikan respons sukses
        return response()->json([
            'success' => true,
            'order' => $order,
            'newStock' => $product->Quantity  // << ini penting untuk frontend  // Mengirimkan data pesanan yang baru dibuat
        ]);
    } catch (\Exception $e) {
        // Jika terjadi error, tangkap dan kembalikan error
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

    public function riwayat()
    {
        $orders = Order::onlyTrashed()->get();
        return view('admin.riwayatorder', compact('orders'));
    }

    public function selesai()
    {
        $orders = Order::where('OrderStatus', 'Selesai')->get();
        return view('admin.ordersselesai', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $previousStatus = $order->OrderStatus;
        $order->OrderStatus = $request->status;
        $order->save();
    
        // Jika status diubah menjadi 'Batal' dan sebelumnya bukan 'Batal'
        if ($request->status === 'Batal' && $previousStatus !== 'Batal') {
            $product = Product::find($order->ProductId);
            if ($product) {
                $product->increment('Quantity', $order->Quantity);
            }
        }
    
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
    

    public function ordersBatal()
    {
        $orders = Order::where('OrderStatus', 'Batal')->get();
        return view('admin.ordersbatal', compact('orders'));
    }

    public function detail($id)
    {
        // Ambil 1 record pesanan berdasarkan id
        $order = Order::findOrFail($id);
    
        // Kirim langsung ke view
        return view('admin.orders-detail', compact('order'));
    }
    
    
}

