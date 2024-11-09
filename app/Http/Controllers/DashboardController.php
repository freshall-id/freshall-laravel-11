<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function viewDashboardPage()
    {
        if(Auth::check() && Auth::user()->role == 'ADMIN') {
            return view('admin.dashboard');
        }

        $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        $products = Product::paginate(12);

        if(Auth::check()) {
            $transactions = Auth::user()->transactions;
        } else {
            $transactions = null;
        }

        // login
        Auth::loginUsingId(1);

        return view('user.dashboard', [
            'products' => $products,
            'product_categories' => $product_categories,
            'transactions' => $transactions
        ]);
    }
}
