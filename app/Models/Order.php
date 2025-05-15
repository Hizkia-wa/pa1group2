<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Orders';
    protected $fillable = [
        'CustomerName', 'Email', 'Phone',
        'total_price', 'City', 'District', 'Address', 'PostalCode',
        'Status',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function items()
    {
    return $this->hasMany(OrderItem::class, 'order_id'); // ganti jika nama kolom foreign key berbeda
    }

}
