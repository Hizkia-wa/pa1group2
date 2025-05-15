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
        $products = Product::where('IsBestSeller', false)->get();
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
    
        // Handle gambar utama
        if ($request->hasFile('ImageMain')) {
            $product->ImageMain = $request->file('ImageMain')->store('products', 'public');
        }
    
        // Handle gambar lainnya
        $imagePaths = [];
        if ($request->hasFile('ImageOthers')) {
            foreach ($request->file('ImageOthers') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }
    
        $product->Images = json_encode($imagePaths);
    
        // Tandai sebagai produk terlaris
        $product->IsBestSeller = $request->has('IsBestSeller', 1);
    
        $product->save();
    
        return redirect()->route('products.best')->with('success', 'Produk terlaris berhasil ditambahkan!');
    }

    public function storeRegular(Request $request)
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

    // Handle gambar utama
    if ($request->hasFile('ImageMain')) {
        $product->ImageMain = $request->file('ImageMain')->store('products', 'public');
    }

    // Handle gambar lainnya
    $imagePaths = [];
    if ($request->hasFile('ImageOthers')) {
        foreach ($request->file('ImageOthers') as $image) {
            $imagePaths[] = $image->store('products', 'public');
        }
    }

    $product->Images = json_encode($imagePaths);

    // Tandai sebagai produk biasa (bukan best seller)
    $product->IsBestSeller = false;

    $product->save();

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
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
            // Buat nama file unik
            $imageName = time() . '_' . $request->file('ImageMain')->getClientOriginalName();
            
            // Simpan file ke folder public
            $request->file('ImageMain')->move(public_path('images/products'), $imageName);
            
            // Simpan path relatif ke database
            $product->image_path = 'images/products/' . $imageName;
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

        if ($product->IsBestSeller) {
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
        $products = Product::where('IsBestSeller', true)->get();
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
        $product = Product::findOrFail($id);
        
        // Pastikan data gambar tersedia dan valid
        if ($product->Images) {
            try {
                $product->image_array = json_decode($product->Images, true);
            } catch (\Exception $e) {
                $product->image_array = [];
            }
        } else {
            $product->image_array = [];
        }
        
        // Tambahkan path lengkap untuk gambar utama
        if ($product->image) {
            $product->main_image_url = asset('storage/app/public/' . $product->image);
        } else {
            $product->main_image_url = asset('images/no-image.png');
        }
        
        $product->all_images = collect($product->image_array)->map(function($img) {
            return asset('storage/app/public/' . $img);
        })->toArray();

        // Jika ada gambar utama, tambahkan ke array all_images jika belum ada
        if ($product->image && !in_array($product->main_image_url, $product->all_images)) {
            array_unshift($product->all_images, $product->main_image_url);
        }
        
        return view('users.detailproduct', compact('product'));
    }

      public function showCustomerDetail($id)
    {
        $product = Product::findOrFail($id);
        
        // Pastikan data gambar tersedia dan valid
        if ($product->Images) {
            try {
                $product->image_array = json_decode($product->Images, true);
            } catch (\Exception $e) {
                $product->image_array = [];
            }
        } else {
            $product->image_array = [];
        }
        
        // Tambahkan path lengkap untuk gambar utama
        if ($product->image) {
            $product->main_image_url = asset('storage/app/public/' . $product->image);
        } else {
            $product->main_image_url = asset('images/no-image.png');
        }
        
        $product->all_images = collect($product->image_array)->map(function($img) {
            return asset('storage/app/public/' . $img);
        })->toArray();

        // Jika ada gambar utama, tambahkan ke array all_images jika belum ada
        if ($product->image && !in_array($product->main_image_url, $product->all_images)) {
            array_unshift($product->all_images, $product->main_image_url);
        }
        
        return view('customer.detailproduct', compact('product'));
    }

    public function showUserCatalog(Request $request)
    {
        // Mulai dengan query dasar
        $query = Product::whereNull('deleted_at');
        
        // Terapkan filter pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ProductName', 'like', "%{$search}%")
                  ->orWhere('Description', 'like', "%{$search}%")
                  ->orWhere('Category', 'like', "%{$search}%");
            });
        }
        
        // Terapkan filter kategori
        if ($request->has('category') && !empty($request->category)) {
            $query->where('Category', $request->category);
        }
        
        // Terapkan pengurutan
        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {
                case 'low':
                    $query->orderBy('Price', 'asc');
                    break;
                case 'high':
                    $query->orderBy('Price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        } else {
            // Pengurutan default
            $query->orderBy('id', 'desc');
        }
        
        // Dapatkan produk dengan paginasi
         $products = $query->get();
        
        // Ambil semua kategori untuk dropdown filter
        $categories = Product::whereNull('deleted_at')
                    ->select('Category')
                    ->distinct()
                    ->pluck('Category');
        
        // Kirim parameter pencarian kembali ke tampilan untuk mempertahankan status
        return view('users.productcatalog', compact('products', 'categories'));
    }

    public function showCustomerCatalog(Request $request)
    {
        // Mulai dengan query dasar
        $query = Product::whereNull('deleted_at');
        
        // Terapkan filter pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ProductName', 'like', "%{$search}%")
                  ->orWhere('Description', 'like', "%{$search}%")
                  ->orWhere('Category', 'like', "%{$search}%");
            });
        }
        
        // Terapkan filter kategori
        if ($request->has('category') && !empty($request->category)) {
            $query->where('Category', $request->category);
        }
        
        // Terapkan pengurutan
        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {
                case 'low':
                    $query->orderBy('Price', 'asc');
                    break;
                case 'high':
                    $query->orderBy('Price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        } else {
            // Pengurutan default
            $query->orderBy('id', 'desc');
        }
        
        // Dapatkan produk dengan paginasi
        $products = $query->paginate(12);
        
        // Ambil semua kategori untuk dropdown filter
        $categories = Product::whereNull('deleted_at')
                    ->select('Category')
                    ->distinct()
                    ->pluck('Category');
        
        // Kirim parameter pencarian kembali ke tampilan untuk mempertahankan status
        return view('customer.productcatalog', compact('products', 'categories'));
    }

    public function showAdminCatalog(Request $request)
    {
        // Mulai dengan query dasar
        $query = Product::whereNull('deleted_at');
        
        // Terapkan filter pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ProductName', 'like', "%{$search}%")
                  ->orWhere('Description', 'like', "%{$search}%")
                  ->orWhere('Category', 'like', "%{$search}%");
            });
        }
        
        // Terapkan filter kategori
        if ($request->has('category') && !empty($request->category)) {
            $query->where('Category', $request->category);
        }
        
        // Terapkan pengurutan
        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {
                case 'low':
                    $query->orderBy('Price', 'asc');
                    break;
                case 'high':
                    $query->orderBy('Price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
                    break;
            }
        } else {
            // Pengurutan default
            $query->orderBy('id', 'desc');
        }
        
        // Dapatkan produk dengan paginasi
        $products = $query->paginate(12);
        
        // Ambil semua kategori untuk dropdown filter
        $categories = Product::whereNull('deleted_at')
                    ->select('Category')
                    ->distinct()
                    ->pluck('Category');
        
        // Kirim parameter pencarian kembali ke tampilan untuk mempertahankan status
        return view('admin.users.productcatalog', compact('products', 'categories'));
    }
}