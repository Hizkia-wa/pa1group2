<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('UserId', auth('customer')->id())
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

        // Cek apakah produk sudah ada di keranjang user
        $cartItem = Cart::where('UserId', auth('customer')->id())
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
                'UserId' => auth('customer')->id(),
                'ProductId' => $request->ProductId,
                'Quantity' => $request->Quantity,
                'Size' => $request->Size,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        Cart::where('id', $id)
            ->where('UserId', auth('customer')->id())
            ->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        // Validasi
        $selected = $request->input('selected');
        if (!$selected || count($selected) === 0) {
            return response()->json(['success' => false, 'message' => 'Tidak ada produk yang dipilih.'], 422);
        }
    
        // Ambil produk
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
        $userId = auth('customer')->id();
        $cartItems = Cart::with('product')->where('UserId', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Buat order utama
        $order = Order::create([
            'UserId' => $userId,
            'TotalPrice' => $cartItems->sum(function ($item) {
                return $item->product->Price * $item->Quantity;
            }),
            'Status' => 'pending',
        ]);

        // Simpan detail per produk (jika kamu punya relasi orderItems)
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'ProductId' => $item->ProductId,
                'Quantity' => $item->Quantity,
                'Price' => $item->product->Price,
                'Size' => $item->Size,
            ]);

            // Kurangi stok produk
            $item->product->decrement('Quantity', $item->Quantity);
        }

        // Kosongkan keranjang
        Cart::where('UserId', $userId)->delete();

        return redirect()->route('customer.orders')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function updateQuantity(Request $request, $id, $size)
    {
        $cartItem = Cart::where('id', $id)
            ->where('UserId', auth('customer')->id())
            ->where('Size', $size)
            ->first();

        if (!$cartItem) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($request->action == 'increase') {
            $cartItem->Quantity += 1;
        } elseif ($request->action == 'decrease' && $cartItem->Quantity > 1) {
            $cartItem->Quantity -= 1;
        }

        $cartItem->save();
        return back()->with('success', 'Jumlah produk diperbarui.');
    }
}
