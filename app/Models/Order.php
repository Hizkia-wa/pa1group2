<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ProductId',
        'CustomerName',
        'Email',
        'Phone',
        'City',
        'District',
        'Address',
        'PostalCode',
        'Size',
        'Quantity',
        'OrderStatus',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId');
    }
}
