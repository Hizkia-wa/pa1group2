<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    // Helper untuk ambil ID dari user aktif (customer atau admin/user)
    private function getCurrentUserId()
    {
        return auth('customer')->check() ? auth('customer')->id() : auth('web')->id();
    }

    public function index()
    {
        $userId = $this->getCurrentUserId();

        $cartItems = Cart::with('product')
            ->where('UserId', $userId)
            ->get();

        return view('customer.keranjang', ['cartWithProduct' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'ProductId' => 'required|exists:products,id',
            'Quantity' => 'required|integer|min:1',
            'Size' => 'required|string',
        ]);

        $userId = $this->getCurrentUserId();

        // Cek apakah produk sudah ada di keranjang user
        $cartItem = Cart::where('UserId', $userId)
            ->where('ProductId', $request->ProductId)
            ->where('Size', $request->Size)
            ->first();

        if ($cartItem) {
            // Jika sudah ada, update quantity
            $cartItem->Quantity += $request->Quantity;
            $cartItem->save();
        } else {
            // Jika belum ada, buat entri baru
            Cart::create([
                'UserId' => $userId,
                'ProductId' => $request->ProductId,
                'Quantity' => $request->Quantity,
                'Size' => $request->Size,
            ]);
        }

        return redirect()->route('customer.cart')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $userId = $this->getCurrentUserId();

        Cart::where('id', $id)
            ->where('UserId', $userId)
            ->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

public function checkout(Request $request)
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

        // Ambil produk berdasarkan ProductId
        $product = Product::findOrFail($request->ProductId);

        // Cek apakah stok cukup
        if ($product->Quantity < $request->Quantity) {
            return redirect()->back()->withErrors(['Stok tidak mencukupi']);
        }

        // Kurangi stok produk
        $product->decrement('Quantity', $request->Quantity);

        // Tentukan nilai default untuk 'Size' jika tidak ada nilai yang dikirim
        $size = 'Medium'; // Nilai default

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
            'Size'         => $size,  // Menambahkan kolom 'Size' dengan nilai default
            'total_price'  => $product->Price * $request->Quantity,
            'OrderStatus'  => 'Diproses',
        ]);

        // Kirim pesan WhatsApp ke admin
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

        $waLink = "https://wa.me/6282274398996?text=" . urlencode($message);

        return redirect($waLink);
    } catch (\Exception $e) {
        // Jika terjadi error, tangkap dan kembalikan error
        return redirect()->back()->withErrors(['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

    public function updateQuantity(Request $request, $id)
{
    $userId = $this->getCurrentUserId();

    // Ambil cart item berdasarkan ID dan ukuran yang dipilih
    $cartItem = Cart::where('id', $id)
        ->where('UserId', $userId)
        ->first();

    if (!$cartItem) {
        return back()->with('error', 'Produk tidak ditemukan.');
    }

    // Ambil produk terkait dari cart item
    $product = $cartItem->product;
    
    // Periksa apakah action untuk menambah atau mengurangi jumlah
    if ($request->action === 'increase') {
        // Cek jika quantity yang diinginkan melebihi stok
        if ($cartItem->Quantity + 1 > $product->Quantity) {
            return back()->with('error', 'Stok produk "' . $product->ProductName . '" tidak mencukupi untuk menambah jumlah.');
        }
        // Jika tidak, tambahkan jumlah produk di keranjang
        $cartItem->Quantity += 1;
    } elseif ($request->action === 'decrease' && $cartItem->Quantity > 1) {
        // Kurangi jumlah produk di keranjang jika lebih dari 1
        $cartItem->Quantity -= 1;
    }

    // Simpan perubahan jumlah produk ke dalam keranjang
    $cartItem->save();

    return back()->with('success', 'Jumlah produk diperbarui.');
}
}
