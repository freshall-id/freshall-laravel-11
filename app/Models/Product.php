<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'image',
        'stock',
        'minimum_buy',
        'weight',
        'price',
        'description',
        'total_sold',
        'rating',

        'product_category_id',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
