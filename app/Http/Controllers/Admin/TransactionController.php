<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
class TransactionController extends Controller
{
    public function updateTransactionHeader(Request $req, $id)
    {
        $status = $req->input('new_status');
        $transaction = TransactionHeader::find($id);
        $transaction->status = $status;
        $transaction->save();

        return redirect()->route('admin-dashboard.page')->with('success', 'Transaction status for id ' . $transaction->id .' updated successfully.');
    }

    public function deleteTransactionHeader(TransactionHeader $transactionHeader)
    {
        $transactionHeader->transactionDetails()->delete();
        $transactionHeader->delete();

        return redirect()->route('admin-dashboard.page')->with('success', 'Transaction with id ' . $transactionHeader->id . ' deleted successfully.');
    }

    public function viewTransactionDetail($id){
        $transactionHeader = TransactionHeader::find($id);
        return view('admin.viewTransactionDetails',['transactionHeader' => $transactionHeader]);
    }
}
