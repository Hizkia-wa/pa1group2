<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'OrderId', 'ProductId', 'Quantity', 'Price', 'Size',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId');
    }
}
