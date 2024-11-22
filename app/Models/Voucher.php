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
    

}
