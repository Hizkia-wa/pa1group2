<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;
    
    protected $guard = 'admin';

    protected $fillable = ['name', 'email', 'password'];
}
