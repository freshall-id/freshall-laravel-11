<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function useVoucher(Request $request) {
        $validated_request = $request->validate([
            'voucher_code' => 'nullable|string|max:20',
        ]);

        if($validated_request['voucher_code'] === null) {
            Auth::user()->cart->voucher_id = null;
            Auth::user()->cart->save();
            
            return redirect()->back()->with('success', 'Voucher code is removed');
        }

        $voucher = Voucher::where('code', $validated_request['voucher_code'])->first();
        
        if(!$voucher) {
            return redirect()->back()->with('error', 'Voucher code is invalid');
        }
        
        Auth::user()->cart->voucher_id = $voucher->id;
        Auth::user()->cart->save(); 
        
        return redirect()->back()->with('success', 'Voucher has been successfully applied');
    }
}
