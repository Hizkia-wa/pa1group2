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
    $userId = $this->getCurrentUserId();

    $cartItems = Cart::with('product')->where('UserId', $userId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang kosong.');
    }

    // Validate customer information
    $request->validate([
        'CustomerName' => 'required|string|max:255',
        'Email' => 'required|email|max:255',
        'Phone' => 'required|string|max:20',
        'City' => 'required|string|max:100',
        'District' => 'required|string|max:100',
        'Address' => 'required|string|max:255',
        'PostalCode' => 'required|string|max:20',
    ]);

    $orderData = [];
    $totalPrice = 0;

    foreach ($cartItems as $item) {
        $product = $item->product;
        $quantity = $item->Quantity;
        $subtotal = $product->Price * $quantity;

        // Get the size for this item, default to 'Medium' if not provided
        $size = $request->input('size_' . $item->id, 'Medium');

        // Check stock availability
        if ($product->Quantity < $quantity) {
            return redirect()->back()->with('error', 'Stok produk "' . $product->ProductName . '" tidak mencukupi.');
        }

        // Store the order in the database
        Order::create([
            'ProductId' => $item->ProductId,
            'CustomerName' => $request->CustomerName,
            'Email' => $request->Email,
            'Phone' => $request->Phone,
            'City' => $request->City,
            'District' => $request->District,
            'Address' => $request->Address,
            'PostalCode' => $request->PostalCode,
            'Quantity' => $quantity,
            'Size' => $size,
            'total_price' => $subtotal,
            'OrderStatus' => 'Diproses',
        ]);

        // Decrement product stock
        $product->decrement('Quantity', $quantity);

        // Add order data to prepare the WhatsApp message
        $orderData[] = [
            'ProductName' => $product->ProductName,
            'Quantity' => $quantity,
            'Price' => $product->Price,
            'Subtotal' => $subtotal,
            'Size' => $size,
        ];

        $totalPrice += $subtotal;
    }

    // Remove all items from the cart after checkout
    Cart::where('UserId', $userId)->delete();

    // Prepare message for WhatsApp
    $message = "Halo Admin, saya ingin memesan produk:\n\n";
    foreach ($orderData as $order) {
        $message .= "📦 *" . $order['ProductName'] . "*\n";
        $message .= "💵 Harga: Rp " . number_format($order['Price'], 0, ',', '.') . "\n";
        $message .= "🔢 Jumlah: " . $order['Quantity'] . "\n";
        $message .= "📏 Ukuran: " . $order['Size'] . "\n";
        $message .= "💵 Subtotal: Rp " . number_format($order['Subtotal'], 0, ',', '.') . "\n\n";
    }
    $message .= "👤 *Nama*: " . $request->CustomerName . "\n";
    $message .= "📱 *Telepon*: " . $request->Phone . "\n";
    $message .= "📧 *Email*: " . $request->Email . "\n";
    $message .= "🏠 *Alamat*: " . $request->Address . ", " . $request->District . ", " . $request->City . " - " . $request->PostalCode . "\n";
    $message .= "💵 *Total Harga*: Rp " . number_format($totalPrice, 0, ',', '.') . "\n\n";
    $message .= "Mohon segera diproses ya 🙏";

    // WhatsApp link
    $waLink = "https://wa.me/6282274398996?text=" . urlencode($message);

    // Redirect to WhatsApp with the order details
    return redirect($waLink);
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
