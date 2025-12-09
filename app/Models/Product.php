<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',  // Foreign key
        'image_main',
        'image_thumbnails',
        'features',
    ];

    // Relasi dengan kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Gunakan casting untuk field JSON
    protected $casts = [
        'image_thumbnails' => 'array',
        'features' => 'array',
    ];

    public function getFeaturesAttribute($value)
{
    // Mengonversi string JSON ke dalam array
    return json_decode($value, true);
}
}
