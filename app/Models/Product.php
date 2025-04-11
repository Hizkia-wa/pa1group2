<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes; // ➕ Aktifkan fitur soft delete

    protected $table = 'Products'; // ➕ Sesuaikan nama tabel (huruf kapital)

    protected $primaryKey = 'id'; // ✔️ Primary key default adalah 'id'

    public $incrementing = true; // ✔️ 'id' auto-increment

    protected $keyType = 'int'; // ✔️ Tipe 'id' adalah integer

    protected $fillable = [
        'ProductName',     // ✔️ Nama produk
        'Quantity',        // ✔️ Jumlah stok
        'Price',           // ✔️ Harga
        'Category',        // ✔️ Kategori produk
        'Description',     // ✔️ Deskripsi produk
        'Images',          // ✔️ Gambar (format JSON)
    ];

    protected $casts = [
        'Images' => 'array', // 🧠 Secara otomatis ubah ke array saat diakses
    ];
}
