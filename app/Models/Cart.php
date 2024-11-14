<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartPrice(): float
    {
        return $this->cartItem->sum(function ($cart_item) {
            return $cart_item->product->price * $cart_item->quantity;
        });
    }
}
