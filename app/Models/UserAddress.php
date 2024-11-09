<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'label',
        'category',
        'full_address',
        'receiver_name',
        'receiver_phone',
        'latitude',
        'longitude',
        'postal_code',
        'notes',
        'is_primary',

        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionHeaders()
    {
        return $this->hasMany(TransactionHeader::class);
    }
}
