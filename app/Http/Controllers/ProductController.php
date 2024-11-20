<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function viewProductDetailPage(Product $product) {
        
        return view('guest.product-detail', [
            'product' => $product
        ]);
    }

    public function storeCreatedProduct(Request $request){
        $categories = ProductCategory::All();

        $request->validate([
            'name' => 'required|string|max:100',
            'sku' => 'required|unique:products,sku',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:1',
            'minimum_buy' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $productData = [
            'sku' => $request->input('sku'),
            'name' => $request->input('name'),
            'stock' => $request->input('stock'),
            'minimum_buy' => $request->input('minimum_buy'),
            'weight' => $request->input('weight'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ];

        $newProduct = Product::create($productData);

        return redirect()->route('create.product.page', ['categories' => $categories])->with('message','Product has been successfully created');
    }

    public function createProduct(){
        $categories = ProductCategory::All();
        return view('admin.createProduct',['categories' => $categories]);
    }
}
