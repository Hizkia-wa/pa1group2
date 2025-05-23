<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
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
        ]);

        $userId = $this->getCurrentUserId();
        $cartItem = Cart::where('UserId', $userId)
            ->where('ProductId', $request->ProductId)
            ->first();

        if ($cartItem) {
            $cartItem->Quantity += $request->Quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'UserId' => $userId,
                'ProductId' => $request->ProductId,
                'Quantity' => $request->Quantity,
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

        $total = 0;
        $orderData = [];
        $outOfStockProducts = [];

        foreach ($selected as $value) {
            $cartItem = Cart::with('product')->find($value);

            if ($cartItem) {
                $product = $cartItem->product;
                $quantity = $cartItem->Quantity;
                $price = $product->Price;
                $subtotal = $price * $quantity;

                if ($product->Quantity < $quantity) {
                    $outOfStockProducts[] = $product->ProductName;
                    continue;
                }

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
                    'total_price'  => $subtotal,
                    'OrderStatus'  => 'Diproses',
                ]);

                $product->decrement('Quantity', $quantity);
                $cartItem->delete();

                $orderData[] = [
                    'ProductId' => $product->id,
                    'Quantity' => $quantity,
                    'Price' => $price,
                    'Subtotal' => $subtotal,
                ];

                $total += $subtotal;
            }
        }

        if (!empty($outOfStockProducts)) {
            $outOfStockMessage = implode(', ', $outOfStockProducts);
            return response()->json([
                'success' => false,
                'message' => 'Stok produk berikut tidak mencukupi: ' . $outOfStockMessage . '. Proses pemesanan gagal.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'products' => collect($orderData)->map(function ($item) {
                return [
                    'name' => Product::find($item['ProductId'])->ProductName ?? 'Produk',
                    'quantity' => $item['Quantity'],
                ];
            }),
            'totalPrice' => $total,
        ]);
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
            $subtotal = $item->product->Price * $item->Quantity;

            Order::create([
                'ProductId' => $item->ProductId,
                'CustomerName' => $request->CustomerName,
                'Email' => $request->Email,
                'Phone' => $request->Phone,
                'City' => $request->City,
                'District' => $request->District,
                'Address' => $request->Address,
                'PostalCode' => $request->PostalCode,
                'Quantity' => $item->Quantity,
                'total_price' => $subtotal,
                'OrderStatus' => 'Diproses',
            ]);

            $item->product->decrement('Quantity', $item->Quantity);
        }

        Cart::where('UserId', $userId)->delete();

        return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat.');
    }
    
    public function updateQuantity(Request $request, $id)
    {
        $userId = $this->getCurrentUserId();

        $cartItem = Cart::where('id', $id)
            ->where('UserId', $userId)
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
