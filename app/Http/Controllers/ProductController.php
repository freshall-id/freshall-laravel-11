<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\GDriveController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function viewProductDetailPage(Product $product) {
        
        return view('guest.product-detail', [
            'product' => $product
        ]);
    }

    public function storeCreatedProduct(Request $request){
        try {
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
                $imagePath = GDriveController::upload($request->file('image'), 'product');
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
                'product_category_id' => $request->input('categoryName')
            ];

            Product::create($productData);
        } catch (Exception $e) {
            Log::error("Error: create for product" . $request['name'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while creating product. Please try again.');
        }

        return redirect()->route('admin-product.page')->with('success','Product has been successfully created');
    }

    public function updateProduct(Request $request, Product $product){
        try {
            $product->productCategory;

            $request->validate([
                'name' => 'required|string|max:100',
                'sku' => 'required|unique:products,sku,' . $product->id,
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
                // $productImageBasename = basename($product->image);
                // $imagePath = 'public/products/' . $productImageBasename;

                // if (Storage::exists($imagePath)) {
                //     // Delete old image
                //     Storage::delete($imagePath);
                // }
                // // Upload new image
                // $imagePath = $request->file('image')->store('products', 'public');
                // $productData['image'] = Storage::url($imagePath);
                if ($product->image && GDriveController::isFileExists($product->image)) {
                    GDriveController::delete($product->image, 'product');
                }
                $imagePath = GDriveController::upload($request->file('image'), 'product');
                $productData['image'] = $imagePath;
            }
            $product->update($productData);
        } catch (Exception $e) {
            Log::error("Error: update for product" . $request['name'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while updating product information. Please try again.');
        }

        return redirect()->route('admin-product.page')->with('success','Product with id ' . $product->id . ' has been successfully updated');
    }

    public function createProduct(){
        $categories = ProductCategory::All();
        return view('admin.createProduct',['categories' => $categories]);
    }

    public function deleteProduct(Product $product){
        // $productImageBasename = basename($product->image);
        // $imagePath = 'public/products/'. $productImageBasename;
        // if (Storage::exists($imagePath)) {
        //     Storage::delete($imagePath);
        // }
        // $product->delete();
        
        try {
            if ($product->image && GDriveController::isFileExists($product->image)) {
                GDriveController::delete($product->image, 'product');
            }
            $product->delete();
        } catch (Exception $e) {
            Log::error("Error: delete for product" . $product->name . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting product. Please try again.');
        }
        return redirect()->route('admin-product.page')->with('success','Product with id ' . $product->id . ' has been successfully deleted');
    }
}
