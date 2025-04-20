<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $productIds = array_column($cart, 'id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Gabungkan info produk ke dalam tiap item keranjang
        $cartWithProduct = array_map(function ($item) use ($products) {
            $product = $products[$item['id']] ?? null;
            return [
                'id' => $item['id'],
                'quantity' => $item['quantity'],
                'size' => $item['size'],
                'product' => $product,
            ];
        }, $cart);

        return view('users.keranjang', compact('cartWithProduct'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
        ]);

        $productId = $request->id;
        $quantity = $request->quantity;
        $size = $request->size;

        $cart = Session::get('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] == $productId && $item['size'] == $size) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $productId,
                'quantity' => $quantity,
                'size' => $size,
            ];
        }

        Session::put('cart', $cart);

        // Cek jika permintaan dari AJAX
        if ($request->ajax()) {
            return response()->json(['message' => 'Produk ditambahkan ke keranjang.']);
        }

        // Jika bukan AJAX, redirect biasa
        return redirect()->route('user.cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        Session::put('cart', array_values($cart));
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'CustomerName' => 'required|string',
            'Email' => 'required|email',
            'Phone' => 'required|string',
            'City' => 'required|string',
            'District' => 'required|string',
            'Street' => 'required|string',
            'PostalCode' => 'required|string',
            'selected' => 'required|array',
        ]);

        $cart = Session::get('cart', []);
        $selected = $request->selected;

        foreach ($selected as $key) {
            list($id, $size) = explode('-', $key);
            foreach ($cart as $item) {
                if ($item['id'] == $id && $item['size'] == $size) {
                    Order::create([
                        'ProductId' => $item['id'],
                        'CustomerName' => $validated['CustomerName'],
                        'Email' => $validated['Email'],
                        'Phone' => $validated['Phone'],
                        'City' => $validated['City'],
                        'District' => $validated['District'],
                        'Address' => $validated['Street'],
                        'PostalCode' => $validated['PostalCode'],
                        'Size' => $item['size'],
                        'Quantity' => $item['quantity'],
                    ]);
                }
            }
        }

        return redirect()->route('user.cart.index')->with('success', 'Pesanan berhasil diproses!');
    }

    public function updateQuantity(Request $request, $id, $size)
    {
        $cart = Session::get('cart', []);
        foreach ($cart as &$item) {
            if ($item['id'] == $id && $item['size'] == $size) {
                if ($request->action == 'increase') {
                    $item['quantity'] += 1;
                } elseif ($request->action == 'decrease' && $item['quantity'] > 1) {
                    $item['quantity'] -= 1;
                }
                break;
            }
        }

        Session::put('cart', $cart);
        return back();
    }
}
