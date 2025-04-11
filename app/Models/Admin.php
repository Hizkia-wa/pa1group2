<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // ⬅️ untuk login (opsional)
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // ⬅️ jika kamu pakai fitur login
{
    use HasFactory, Notifiable;

    protected $table = 'Admins'; // ⬅️ disesuaikan dengan nama tabel di migrasi
    protected $primaryKey = 'id'; // ⬅️ disesuaikan dengan struktur migrasi kamu

    protected $fillable = [
        'AdminName',
        'Email',
        'Password',
    ];

    public $timestamps = true;

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * Override agar Laravel tahu password pakai field 'Password', bukan 'password'.
     */
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
