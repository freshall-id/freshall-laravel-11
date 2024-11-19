<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'total_price',
        'cart_id',
        'product_id',
    ];

    // the relationship with other model
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // model method
    public function totalPrice(): float
    {
        return $this->product->price * $this->quantity;
    }

    public function totalPriceToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->totalPrice(), 0, ',', '.');
    }
}
