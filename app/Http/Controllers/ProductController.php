<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_best_seller', false)->get();
        return view('admin.productpage', compact('products'));
    }

    public function bestSellers()
    {
        $products = Product::withCount('orderItems') // pastikan relasi 'orderItems' ada
                    ->orderBy('order_items_count', 'desc')
                    ->take(10)
                    ->get();

        return view('admin.bestproductpage', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function createBestSeller()
    {
        return view('admin.createbestproduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Quantity' => 'required|integer|min:0',
            'Category' => 'required|string',
            'Description' => 'nullable|string',
            'ImageMain' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ImageOthers.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);        

        $product = new Product();
        $product->ProductName = $request->ProductName;
        $product->Price = $request->Price;
        $product->Quantity = $request->Quantity;
        $product->Category = $request->Category;
        $product->Description = $request->Description;

        // Handle gambar
        $imagePaths = [];

        if ($request->hasFile('ImageMain')) {
            $imagePaths[] = $request->file('ImageMain')->store('products', 'public');
        }

        if ($request->hasFile('ImageOthers')) {
            foreach ($request->file('ImageOthers') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        $product->Images = json_encode($imagePaths);

        // Tandai sebagai produk terlaris
        $product->is_best_seller = $request->has('is_best_seller');

        $product->save();

        return redirect()->route('products.best')->with('success', 'Produk terlaris berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.detail', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.editproduct', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Category' => 'required|string',
            'Description' => 'nullable|string',
        ]);

        $images = json_decode($product->Images, true) ?? [];

        if ($request->hasFile('ImageMain')) {
            $images[] = $request->file('ImageMain')->store('products', 'public');
        }

        if ($request->hasFile('ImageOthers')) {
            foreach ($request->file('ImageOthers') as $file) {
                $images[] = $file->store('products', 'public');
            }
        }

        $product->update([
            'ProductName' => $request->ProductName,
            'Price' => $request->Price,
            'Category' => $request->Category,
            'Description' => $request->Description,
            'Images' => json_encode($images),
        ]);

        if ($product->is_best_seller) {
            return redirect()->route('products.best')->with('success', 'Produk terlaris berhasil diperbarui!');
        } else {
            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // soft delete
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
    // Tampilkan produk terlaris (misalnya: berdasarkan kriteria manual, atau Category = 'Terlaris')
    public function bestProducts()
    {
        $products = Product::where('is_best_seller', true)->get();
        return view('admin.bestproductpage', compact('products'));
    }
    
    public function createBestProduct()
    {
        return view('admin.createbestproduct');
    }    

    public function showDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.detailproduct', compact('product'));
    }

    public function riwayat()
    {
        $deletedProducts = Product::onlyTrashed()->get();
        return view('admin.riwayatproduct', compact('deletedProducts'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.riwayat')->with('success', 'Produk berhasil dipulihkan.');
    }

    public function showUserDetail($id)
    {
        $product = Product::findOrFail($id); // Ambil data berdasarkan ID
        return view('users.detailproduct', compact('product'));
    }

    
}