<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil data produk dengan kolom sesuai tabel baru
        $products = Product::select('id', 'product_name', 'category', 'price', 'description', 'images')->get();

        return view('admin.products', compact('products'));
    }

    public function create()
    {
        return view('admin.create_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'main_image' => 'required|image|mimes:jpg,png|max:2048',
            'carousel_images.*' => 'image|mimes:jpg,png|max:2048',
        ]);

        // Simpan gambar utama
        $mainImagePath = $request->file('main_image')->store('images', 'public');

        // Simpan gambar carousel
        $carouselImages = [];
        if ($request->hasFile('carousel_images')) {
            foreach ($request->file('carousel_images') as $image) {
                $carouselImages[] = $image->store('images', 'public');
            }
        }

        // Simpan data ke database
        Product::create([
            'product_name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'images' => json_encode([
                'main' => $mainImagePath,
                'carousel' => $carouselImages,
            ]),
        ]);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product->images, true);

        return view('admin.product_detail', compact('product', 'images'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product->images, true);

        return view('admin.edit_product', compact('product', 'images'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'main_image' => 'image|mimes:jpg,png|max:2048',
            'carousel_images.*' => 'image|mimes:jpg,png|max:2048',
        ]);

        $product->product_name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;

        $images = json_decode($product->images, true);

        // Update gambar utama jika di-upload ulang
        if ($request->hasFile('main_image')) {
            $images['main'] = $request->file('main_image')->store('images', 'public');
        }

        // Update carousel jika ada
        if ($request->hasFile('carousel_images')) {
            $carouselImages = [];
            foreach ($request->file('carousel_images') as $image) {
                $carouselImages[] = $image->store('images', 'public');
            }
            $images['carousel'] = $carouselImages;
        }

        $product->images = json_encode($images);
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function history()
    {
        $deletedProducts = Product::onlyTrashed()->get();
        return view('admin.product_history', compact('deletedProducts'));
    }

    public function restore($id)
    {
        Product::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.products.history')->with('success', 'Produk berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        Product::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.products.history')->with('success', 'Produk berhasil dihapus permanen.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $images = json_decode($product->images, true);

        if (isset($images['main'])) {
            Storage::disk('public')->delete($images['main']);
        }

        if (isset($images['carousel']) && is_array($images['carousel'])) {
            foreach ($images['carousel'] as $carousel) {
                Storage::disk('public')->delete($carousel);
            }
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }
}
