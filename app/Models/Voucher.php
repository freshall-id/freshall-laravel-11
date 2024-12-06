<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'min_price',
        'max_discount',
        'expired_at',
        'quantity',
        'used',
    ];

    public function transactionHeaders()
    {
        return $this->hasMany(TransactionHeader::class);
    }

    public function carts (): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function isExpired(): bool
    {
        return now()->greaterThan($this->expired_at);
    }

    public function minPriceToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->min_price, 0, ',', '.');
    }
    public function maxDiscountToNumberFormat(): string
    {
        return 'Rp ' . number_format($this->max_discount, 0, ',', '.');
    }
    public function discountToNumberFormat(): string
    {
        return number_format($this->discount, 2, ',') .' %';
    }
    

}
