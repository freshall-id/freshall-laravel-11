<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price'
    ];

    // static variable
    public float $insuranceRate = 0.02;

    // boot method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cart) {
            $cart->price_fee = 1000;
        });
    }

    // the relationship with other model
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    // model method
    public function totalItemPrice(): float
    {
        $total_price = 0;

        foreach ($this->cartItems as $cart_item) {
            $total_price += $cart_item->product->price * $cart_item->quantity;
        }

        return $total_price;
    }

    public function totalItemPriceToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->totalItemPrice(), 0, ',', '.');
    }

    public function totalDiscountPrice(): float
    {
        if(!$this->voucher) {
            return 0;
        }

        return $this->totalItemPrice() * $this->voucher->discount / 100;
    }

    public function totalDiscountPriceToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->totalDiscountPrice(), 0, ',', '.');
    }

    public function totalInsurancePrice(): float
    {
        return $this->totalItemPrice() * $this->insuranceRate;
    }

    public function totalInsurancePriceToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->totalInsurancePrice(), 0, ',', '.');
    }

    public function totalPrice(): float
    {
        $subtotal = $this->totalItemPrice();
        $discount = $this->totalDiscountPrice();
        $insurance = $this->totalInsurancePrice();
        $shipping = $this->price_shipping;
        
        return $subtotal - $discount + $insurance + $shipping;
    }

    public function totalPriceToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->totalPrice(), 0, ',', '.');
    }

    public function priceFeeToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->price_fee, 0, ',', '.');
    }
}