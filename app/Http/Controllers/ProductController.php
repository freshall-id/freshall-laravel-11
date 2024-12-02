<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function viewProductDetailPage(Product $product) {
        
        return view('guest.product-detail', [
            'product' => $product
        ]);
    }

    public function storeCreatedProduct(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'sku' => 'required|unique:products,sku',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:1',
            'minimum_buy' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categoryName' => 'required|exists:product_categories,id'
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
            'image' => Storage::url($imagePath),
            'product_category_id' => $request->input('categoryName')
        ];

        $newProduct = Product::create($productData);

        return redirect()->route('admin-product.page')->with('success','Product has been successfully created');
    }

    public function updateProduct(Request $request, Product $product){
        $request->validate([
            'name' => 'required|string|max:100',
            'sku' => 'required|unique:products,sku,'. $product->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:1',
            'minimum_buy' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categoryName' => 'required|exists:product_categories,id'
        ]);

        $productData = [
            'sku' => $request->input('sku'),
            'name' => $request->input('name'),
            'stock' => $request->input('stock'),
            'minimum_buy' => $request->input('minimum_buy'),
            'weight' => $request->input('weight'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'product_category_id' => $request->input('categoryName')
        ];

        if ($request->hasFile('image')) {
            $productImageBasename = basename($product->image);
            $imagePath = 'public/products/' . $productImageBasename;
            
            if (Storage::exists($imagePath)) {
                // Delete old image
                Storage::delete($imagePath);
            }
            // Upload new image
            $imagePath = $request->file('image')->store('products', 'public');
            $productData['image'] = Storage::url($imagePath);
        }

        $product->update($productData);

        return redirect()->route('admin-product.page')->with('success','Product with id ' . $product->id . ' has been successfully updated');
    }

    public function createProduct(){
        $categories = ProductCategory::All();
        return view('admin.createProduct',['categories' => $categories]);
    }

    public function deleteProduct(Product $product){
        $productImageBasename = basename($product->image);
        $imagePath = 'public/products/'. $productImageBasename;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $product->delete();
        
        return redirect()->route('admin-product.page')->with('success','Product with id ' . $product->id . ' has been successfully deleted');
    }
}
