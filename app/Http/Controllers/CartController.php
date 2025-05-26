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
            'selected' => 'required|array',  // Mengharuskan ada produk yang dipilih
        ]);

        $totalQuantity = 0;
        $totalPrice = 0;

        // Loop melalui produk yang dipilih
        foreach ($request->selected as $productId) {
            // Ambil produk dari keranjang
            $cartItem = Cart::where('UserId', auth()->id())
                            ->where('ProductId', $productId)
                            ->first();

            if ($cartItem) {
                $product = $cartItem->product;
                $quantity = $cartItem->Quantity;
                $subtotal = $product->Price * $quantity;

                // Cek apakah stok cukup
                if ($product->Quantity < $quantity) {
                    return redirect()->back()->withErrors(['Stok produk "' . $product->ProductName . '" tidak mencukupi']);
                }

                // Kurangi stok produk
                $product->decrement('Quantity', $quantity);

                // Simpan pesanan
                Order::create([
                    'ProductId'    => $product->id,
                    'CustomerName' => $request->name,
                    'Email'        => $request->email,
                    'Phone'        => $request->phone,
                    'City'         => $request->city,
                    'District'     => $request->district,
                    'Address'      => $request->address,
                    'PostalCode'   => $request->postal_code,
                    'Quantity'     => $quantity,
                    'Size'         => 'Medium',  // Nilai default
                    'total_price'  => $subtotal,
                    'OrderStatus'  => 'Diproses',
                ]);

                // Tambahkan ke total
                $totalQuantity += $quantity;
                $totalPrice += $subtotal;

                // Hapus item dari keranjang
                $cartItem->delete();
            }
        }

        // Kirim pesan WhatsApp ke admin
        $message = "Halo Admin, saya ingin memesan produk:\n\n";
        $message .= "Jumlah: $totalQuantity\n";
        $message .= "Total Harga: Rp " . number_format($totalPrice, 0, ',', '.') . "\n";
        $message .= "Pesanan dari: " . $request->name . "\n";
        $message .= "Telepon: " . $request->phone . "\n";
        $message .= "Alamat: " . $request->address . ", " . $request->district . ", " . $request->city . "\n";

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
