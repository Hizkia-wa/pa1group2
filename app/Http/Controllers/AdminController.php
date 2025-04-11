<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin
     */
    public function dashboard()
    {
        $jumlahProduk = Product::count();
        $jumlahKategori = Product::distinct('Category')->count('Category'); // Kategori unik dari produk
        $jumlahUlasan = Review::count();

        return view('admin.dashboard', compact('jumlahProduk', 'jumlahKategori', 'jumlahUlasan'));
    }

    /**
     * Menampilkan halaman manajemen produk
     */
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    /**
     * Menampilkan halaman ulasan pelanggan
     */
    public function reviews()
    {
        $reviews = Review::all();
        return view('admin.reviews', compact('reviews'));
    }

    /**
     * Menampilkan halaman tampilan website dari sisi admin
     */
    public function website()
    {
        return view('admin.website');
    }

    /**
     * Menampilkan daftar semua admin
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    /**
     * Menampilkan form untuk menambahkan admin baru
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Menyimpan admin baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'AdminName' => 'required|string|max:255',
            'Email' => 'required|email|unique:admins,Email',
            'Password' => 'required|string|min:6'
        ]);

        Admin::create([
            'AdminName' => $request->AdminName,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password)
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit data admin
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    /**
     * Memperbarui data admin
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'AdminName' => 'required|string|max:255',
            'Email' => 'required|email|unique:admins,Email,' . $admin->id,
            'Password' => 'nullable|min:6'
        ]);

        $admin->AdminName = $request->AdminName;
        $admin->Email = $request->Email;

        if ($request->filled('Password')) {
            $admin->Password = Hash::make($request->Password);
        }

        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Menghapus admin dari database
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus.');
    }
}
