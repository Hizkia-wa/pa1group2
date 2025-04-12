<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'Products';

    protected $fillable = [
        'ProductName',
        'Quantity',
        'Price',
        'Category',
        'Description',
        'Images',
    ];

    protected $casts = [
        'Images' => 'array', // karena format JSON
    ];
}
