<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\GDriveController;

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
        $products = $category->products()->paginate(10);

        return view('guest.product-category', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function storeCreatedProductCategory(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                'label' => 'required|string|max:50',
                'name' => 'required|string|max:50|unique:product_categories,name',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
            ]);

            if ($request->hasFile('image')) {
                $imagePath = GDriveController::upload($request->file('image'), 'category');
            }

            $productCategoryData = [
                'label' => $request->input('label'),
                'name' => $request->input('name'),
                'image' => $imagePath,
                'description' => $request->input('description'),
            ];

            ProductCategory::create($productCategoryData);
        } catch (Exception $e) {
            Log::error("Error: create for product category with label " . $request['label'] . "and name " . $request['name'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while creating product. Please try again.');
        }

        return redirect()->route('admin-productCategory.page')->with('success', 'Product Category has been successfully created');
    }

    public function updateProductCategory(Request $request, ProductCategory $productCategory)
    {
        try {
            $request->validate([
                'label' => 'required|string|max:50',
                'name' => 'required|string|max:50|unique:product_categories,name,' . $productCategory->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
            ]);

            $productCategoryData = [
                'label' => $request->input('label'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ];

            if ($request->hasFile('image')) {
                if ($productCategory->image && GDriveController::isFileExists($productCategory->image)) {
                    GDriveController::delete($productCategory->image, 'category');
                }
                $imagePath = GDriveController::upload($request->file('image'), 'category');
                $productCategoryData['image'] = $imagePath;
            }
            $productCategory->update($productCategoryData);
        } catch (Exception $e) {
            Log::error("Error: update for  product category with label " . $request['label'] . " and name " . $request['name'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while updating product category information. Please try again.');
        }

        return redirect()->route('admin-productCategory.page')->with('success', 'Product Category with id ' . $productCategory->id . ' has been successfully updated');
    }

    public function createProductCategory()
    {
        $categories = ProductCategory::All();
        return view('admin.createProductCategory', ['categories' => $categories]);
    }
}
