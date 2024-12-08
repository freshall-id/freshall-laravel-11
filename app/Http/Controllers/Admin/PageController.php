<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TransactionHeader;
use App\Models\User;
use App\Models\Voucher;
use App\Utils\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function viewDashboardPage(Request $req)
    {
        $selected = $req->query('selected', 'PENDING');
        $allTransactions = TransactionHeader::all();
        $transactions = TransactionHeader::with('transactionDetails')->where('status', $selected)->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        $canUpdate = true;
        $canDelete = true;
        if ($selected === 'COMPLETED' || $selected === 'CANCELLED' || $selected === 'FAILED') {
            $canUpdate = false;
        }
        if ($selected === 'INPROCESS' || $selected === 'COMPLETED' || $selected === 'TROUBLE' || $selected === 'ONHOLD') {
            $canDelete = false;
        }

        $transactionsMonthly = $allTransactions->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);

        $earningsMonthly = $transactionsMonthly->sum('price_total');
        $earningsMonthly = Formatter::ToNumberFormat($earningsMonthly);

        $totalTransactionsMonthly = $transactionsMonthly->count();

        $transactionsTrouble = $allTransactions->where('status', 'TROUBLE')->count();
        $transactionsInProcess = $allTransactions->where('status', 'INPROCESS')->count();

        return view('admin.dashboard', [
            'transactions' => $transactions,
            'selected' => $selected,
            'canUpdate' => $canUpdate,
            'canDelete' => $canDelete,
            'earningsMonthly' => $earningsMonthly,
            'totalTransactionsMonthly' => $totalTransactionsMonthly,
            'transactionsTrouble' => $transactionsTrouble,
            'transactionsInProcess' => $transactionsInProcess
        ]);
    }

    public function viewProductPage(Request $req)
    {
        $selected = $req->query('selected', 'FRUIT');

        $products = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->where('product_categories.label', $selected)
            ->select('products.*')
            ->orderBy('products.id', 'asc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.product', ['products' => $products, 'categoriesLabel' => ['FRUIT', 'VEGETABLE', 'MEAT', 'OTHER'], 'selected' => $selected]);
    }

    public function viewUpdateProductPage(Product $product)
    {
        $categories = ProductCategory::All();
        return view('admin.updateProduct', ['product' => $product, 'categories' => $categories]);
    }

    public function viewVoucherPage()
    {
        $vouchers = Voucher::paginate(10);
        return view('admin.voucher', ['vouchers' => $vouchers]);
    }

    public function viewUpdateVoucherPage(Voucher $voucher)
    {
        return view('admin.updateVoucher', ['voucher' => $voucher]);
    }

    public function viewUserPage(User $user)
    {
        $users = User::withTrashed()->paginate(10);

        return view('admin.viewUser', ['users' => $users]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        
        return redirect()->route('admin-user.page')->with('success', 'User with id ' . $user->id . ' deleted successfully.');
    }

    public function restoreUser(User $user)
    {
        $user->restore();

        return redirect()->route('admin-user.page')->with('success', 'User with id ' . $user->id . ' recovered successfully.');
    }
}
