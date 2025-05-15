<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'Orders';

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
        'total_price',
        'OrderStatus',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId');
    }
}