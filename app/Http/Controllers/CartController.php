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
            'ProductId' => 'required|exists:Products,id',
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
        $selected = $request->input('selected');

        if (!$selected || count($selected) === 0) {
            return response()->json(['success' => false, 'message' => 'Tidak ada produk yang dipilih.'], 422);
        }

        $items = [];
        $total = 0;

        foreach ($selected as $value) {
            list($cartId, $size) = explode('-', $value);
            $cartItem = Cart::with('product')->find($cartId);

            if ($cartItem) {
                $items[] = [
                    'name' => $cartItem->product->ProductName,
                    'size' => $cartItem->Size,
                    'quantity' => $cartItem->Quantity,
                    'price' => $cartItem->product->Price,
                ];

                $total += $cartItem->Quantity * $cartItem->product->Price;
            }
        }

        return response()->json([
            'success' => true,
            'products' => $items,
            'totalPrice' => $total
        ]);
    }

    public function processCheckout(Request $request)
    {
        $userId = $this->getCurrentUserId();

        $cartItems = Cart::with('product')->where('UserId', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        $order = Order::create([
            'UserId' => $userId,
            'TotalPrice' => $cartItems->sum(function ($item) {
                return $item->product->Price * $item->Quantity;
            }),
            'Status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'ProductId' => $item->ProductId,
                'Quantity' => $item->Quantity,
                'Price' => $item->product->Price,
                'Size' => $item->Size,
            ]);

            $item->product->decrement('Quantity', $item->Quantity);
        }

        Cart::where('UserId', $userId)->delete();

        return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function updateQuantity(Request $request, $id, $size)
    {
        $userId = $this->getCurrentUserId();

        $cartItem = Cart::where('id', $id)
            ->where('UserId', $userId)
            ->where('Size', $size)
            ->first();

        if (!$cartItem) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($request->action === 'increase') {
            $cartItem->Quantity += 1;
        } elseif ($request->action === 'decrease' && $cartItem->Quantity > 1) {
            $cartItem->Quantity -= 1;
        }

        $cartItem->save();

        return back()->with('success', 'Jumlah produk diperbarui.');
    }
}
