<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function viewProductCategoryByLabelPage(string $label)
    {
        
        $products = Product::whereHas('productCategory', function($query) use ($label) {
            $query->where('label', $label);
        })->paginate(10);

        if($products->isEmpty()) {
            return redirect()->route('dashboard.page')->with('error', 'No products found for this category.');
        }
        
        return view('guest.product-category', [
            'products' => $products,
            'label' => $label
        ]);
    }

    public function viewProductCategoryByCategoryPage(ProductCategory $category)
    {
        return view('guest.product-category', [
            'products' => $category->products->paginate(10),
            'category' => $category
        ]);
    }
}
