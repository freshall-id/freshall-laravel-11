<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TransactionHeader;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function viewDashboardPage(Request $req)
    {
        $selected = $req->query('selected', 'PENDING');

        $transactions = TransactionHeader::where('status', $selected)->paginate(1)->withQueryString();

        return view('admin.dashboard', ['transactions' => $transactions, 'selected' => $selected]);
    }
}
