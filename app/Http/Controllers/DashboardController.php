<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TransactionHeader;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\TransactionStatus;

class DashboardController extends Controller
{
    public function viewDashboardPage()
    {
        if(Auth::check() && Auth::user()->role == 'ADMIN') {
            return redirect()->route('admin-dashboard.page');
        }

        $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        $products = Product::paginate(12);
        $vouchers = Voucher::where('expired_at', '>', now())->get();

        if(Auth::check()) {
            $transactions = Auth::user()->transactions;
        } else {
            $transactions = null;
        }

        return view('guest.dashboard', [
            'products' => $products,
            'product_categories' => $product_categories,
            'transactions' => $transactions,
            'vouchers' => $vouchers,
        ]);
    }
}
