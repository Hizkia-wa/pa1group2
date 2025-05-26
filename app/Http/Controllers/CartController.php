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
    // Get selected products from the form
    $selectedItems = $request->input('selected', []);
    
    if (empty($selectedItems)) {
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
    }

    $totalQuantity = 0;
    $totalPrice = 0;
    $orderData = [];
    $outOfStockProducts = [];

    // Process each selected product
    foreach ($selectedItems as $cartId) {
        $cartItem = Cart::with('product')->find($cartId);

        if ($cartItem) {
            $product = $cartItem->product;
            $quantity = $cartItem->Quantity; // Get the quantity selected
            $subtotal = $product->Price * $quantity;

            // Check stock availability
            if ($product->Quantity < $quantity) {
                $outOfStockProducts[] = $product->ProductName;
                continue; // Skip if product is out of stock
            }

            // Save order data
            $orderData[] = [
                'ProductName' => $product->ProductName,
                'Quantity' => $quantity,
                'Subtotal' => $subtotal,
            ];

            // Calculate total price and quantity
            $totalQuantity += $quantity;
            $totalPrice += $subtotal;

            // Decrease product stock
            $product->decrement('Quantity', $quantity);

            // Remove item from cart after checkout
            $cartItem->delete();
        }
    }

    // If there are out of stock products
    if (!empty($outOfStockProducts)) {
        $outOfStockMessage = implode(', ', $outOfStockProducts);
        return redirect()->back()->with('error', 'Stok produk berikut tidak mencukupi: ' . $outOfStockMessage);
    }

    // Save the order in the database
    $order = Order::create([
        'ProductId' => $product->id, // Take the last product for the order (change this logic if needed)
        'CustomerName' => $request->CustomerName,
        'Email' => $request->Email,
        'Phone' => $request->Phone,
        'City' => $request->City,
        'District' => $request->District,
        'Address' => $request->Street,
        'PostalCode' => $request->PostalCode,
        'Quantity' => $totalQuantity,
        'total_price' => $totalPrice,
        'OrderStatus' => 'Diproses',
    ]);

    // Send WhatsApp message to the admin
    $message = "Halo Admin, saya ingin memesan produk:\n\n";
    foreach ($orderData as $data) {
        $message .= "📦 *" . $data['ProductName'] . "* - Jumlah: " . $data['Quantity'] . " - Subtotal: Rp " . number_format($data['Subtotal'], 0, ',', '.') . "\n";
    }
    $message .= "💵 *Total Harga*: Rp " . number_format($totalPrice, 0, ',', '.') . "\n";
    $message .= "👤 *Nama*: " . $request->CustomerName . "\n";
    $message .= "📱 *Telepon*: " . $request->Phone . "\n";
    $message .= "📧 *Email*: " . $request->Email . "\n";
    $message .= "🏠 *Alamat*: " . $request->Street . ", " . $request->District . ", " . $request->City . " - " . $request->PostalCode . "\n";

    // Redirect to WhatsApp to send the message
    $waLink = "https://wa.me/6282274398996?text=" . urlencode($message);
    return redirect($waLink);
}


public function processCheckout(Request $request)
{
    $userId = $this->getCurrentUserId();

    $cartItems = Cart::with('product')->where('UserId', $userId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang kosong.');
    }

    $request->validate([
        'CustomerName' => 'required|string|max:255',
        'Email' => 'required|email|max:255',
        'Phone' => 'required|string|max:20',
        'City' => 'required|string|max:100',
        'District' => 'required|string|max:100',
        'Address' => 'required|string|max:255',
        'PostalCode' => 'required|string|max:20',
    ]);

    // Loop untuk proses checkout
    foreach ($cartItems as $item) {
        $product = $item->product;
        $quantity = $item->Quantity;
        $subtotal = $product->Price * $quantity;

        // Cek apakah stok cukup
        if ($product->Quantity < $quantity) {
            return redirect()->back()->with('error', 'Stok produk "' . $product->ProductName . '" tidak mencukupi.');
        }

        // Simpan pesanan
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
            'total_price' => $subtotal,
            'OrderStatus' => 'Diproses',
        ]);

        // Kurangi stok produk
        $product->decrement('Quantity', $quantity);
    }

    // Hapus semua item dari keranjang setelah checkout
    Cart::where('UserId', $userId)->delete();

    return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat.');
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
