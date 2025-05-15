<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'UserId',
        'ProductId',
        'Quantity',
        'Size',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'ProductId');
    }
}
