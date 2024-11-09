<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'status',

        'shipping_provider',
        'shipping_receipt_number',
        'shipping_status',

        'payment_method',
        'payment_receipt_number',
        'payment_status',

        'price_shipping',
        'price_items',
        'price_discount',
        'price_insurance',
        'price_fee',
        'price_total',

        'notes',

        'user_id',
        'user_address_id',
        'voucher_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
