<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'size', 'quantity', 'price', 'total_price', 'shipping_cost', 'address', 'city', 'courier', 'payment_method', 'status','payment_proof'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    

    public function customer()
{
    return $this->belongsTo(User::class); // Relasi antara Order dan User
}
}
