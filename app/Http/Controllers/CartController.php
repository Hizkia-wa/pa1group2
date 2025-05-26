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
    // Validate selected items and customer info
    $selected = $request->input('selected');
    if (!$selected || count($selected) === 0) {
        return response()->json(['success' => false, 'message' => 'Tidak ada produk yang dipilih.'], 422);
    }

    $total = 0;
    $orderData = [];
    $outOfStockProducts = [];

    // Process each selected item
    foreach ($selected as $value) {
        list($cartId) = explode('-', $value);
        $cartItem = Cart::with('product')->find($cartId);

        if ($cartItem) {
            $product = $cartItem->product;
            $quantity = $cartItem->Quantity;
            $price = $product->Price;
            $subtotal = $price * $quantity;

            // Check product stock
            if ($product->Quantity < $quantity) {
                $outOfStockProducts[] = $product->ProductName;
                continue;
            }

            // Set default size if not specified
            $size = 'Medium'; // Default size

            // Save order in the database
            Order::create([
                'ProductId'    => $product->id,
                'CustomerName' => $request->CustomerName,
                'Email'        => $request->Email,
                'Phone'        => $request->Phone,
                'City'         => $request->City,
                'District'     => $request->District,
                'Address'      => $request->Street,
                'PostalCode'   => $request->PostalCode,
                'Quantity'     => $quantity,
                'Size'         => $size,
                'total_price'  => $subtotal,
                'OrderStatus'  => 'Diproses',
            ]);

            // Decrease product stock
            $product->decrement('Quantity', $quantity);

            // Remove from cart
            $cartItem->delete();

            // Prepare order data
            $orderData[] = [
                'ProductId' => $product->id,
                'Quantity' => $quantity,
                'Price' => $price,
                'Subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }
    }

    // If there are out-of-stock products
    if (!empty($outOfStockProducts)) {
        $outOfStockMessage = implode(', ', $outOfStockProducts);
        return response()->json([
            'success' => false,
            'message' => 'Stok produk berikut tidak mencukupi: ' . $outOfStockMessage . '. Proses pemesanan gagal.'
        ], 422);
    }

    // Prepare WhatsApp message
    $message = "Halo Admin, saya ingin memesan produk:\n\n";
    foreach ($orderData as $item) {
        $message .= "🛒 *" . Product::find($item['ProductId'])->ProductName . "* x" . $item['Quantity'] . "\n";
    }

    $message .= "💵 *Total Harga*: Rp " . number_format($total, 0, ',', '.') . "\n";
    $message .= "👤 *Nama*: " . $request->CustomerName . "\n";
    $message .= "📱 *Telepon*: " . $request->Phone . "\n";
    $message .= "📧 *Email*: " . $request->Email . "\n";
    $message .= "🏠 *Alamat*: " . $request->Street . ", " . $request->District . ", " . $request->City . ", " . $request->PostalCode . "\n";

    // WhatsApp link
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

    foreach ($cartItems as $item) {
        $product = $item->product;
        $quantity = $item->Quantity;
        $subtotal = $product->Price * $quantity;

        // Cek apakah stok produk mencukupi
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
