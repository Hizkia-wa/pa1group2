<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // menampilkan semua produk
        return view('admin.productpage', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Category' => 'required|string',
            'Description' => 'nullable|string',
            'ImageMain' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ImageOthers.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('ImageMain')) {
            $mainImagePath = $request->file('ImageMain')->store('products', 'public');
            $images[] = $mainImagePath;
        }

        if ($request->hasFile('ImageOthers')) {
            foreach ($request->file('ImageOthers') as $file) {
                $images[] = $file->store('products', 'public');
            }
        }

        Product::create([
            'ProductName' => $request->ProductName,
            'Price' => $request->Price,
            'Quantity' => 1, // default
            'Category' => $request->Category,
            'Description' => $request->Description,
            'Images' => json_encode($images),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
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

        $images = $product->Images ?? [];

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
            'Images' => $images,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // soft delete
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}
