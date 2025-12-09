<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'categories';
    protected $fillable = [
        'name',
    ];

    // Relasi dengan produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
