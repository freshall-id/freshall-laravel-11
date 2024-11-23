<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\TransactionHeader;
use App\Models\Voucher;
use App\Utils\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function viewDashboardPage(Request $req)
    {
        $selected = $req->query('selected', 'PENDING');
        $allTransactions = TransactionHeader::all();
        $transactions = TransactionHeader::with('transactionDetails')->where('status', $selected)->paginate(5)->withQueryString();

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
}
