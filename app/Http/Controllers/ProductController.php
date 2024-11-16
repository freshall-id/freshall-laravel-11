<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProductDetailPage(Product $product) {
        
        return view('guest.product-detail', [
            'product' => $product
        ]);
    }
}
