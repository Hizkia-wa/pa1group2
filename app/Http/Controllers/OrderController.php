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
            'Quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->ProductId);

        // Cek apakah stok cukup
        if ($product->Quantity < $request->Quantity) {
            return redirect()->back()->withErrors(['Stok tidak mencukupi']);
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
            'Quantity'     => $request->Quantity,
            'total_price'  => $product->Price * $request->Quantity,
            'OrderStatus'  => 'Diproses',
        ]);

        // Membuat pesan WhatsApp untuk admin
        $message = "Halo Admin, saya ingin memesan produk:\n\n";
        $message .= "📦 *" . $product->ProductName . "*\n";
        $message .= "📁 Kategori: " . $product->Category . "\n";
        $message .= "💵 Harga: Rp " . number_format($product->Price, 0, ',', '.') . "\n";
        $message .= "👤 Nama: " . $request->name . "\n";
        $message .= "📱 Telepon: " . $request->phone . "\n";
        $message .= "📧 Email: " . $request->email . "\n";
        $message .= "🏠 Alamat: " . $request->address . ", " . $request->district . ", " . $request->city . ", " . $request->postal_code . "\n";
        $message .= "🔢 Jumlah: " . $request->Quantity . "\n\n";
        $message .= "Mohon segera diproses ya 🙏";

        // Kirimkan pesan WhatsApp ke admin
        $waLink = "https://wa.me/6282274398996?text=" . urlencode($message);
        return redirect($waLink);
    } catch (\Exception $e) {
        // Jika terjadi error, tangkap dan kembalikan error
        return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
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

