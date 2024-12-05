<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function useVoucher(Request $request)
    {
        $validated_request = $request->validate([
            'voucher_code' => 'nullable|string|max:20',
        ]);

        if ($validated_request['voucher_code'] === null) {
            Auth::user()->cart->voucher_id = null;
            Auth::user()->cart->save();

            return redirect()->back()->with('success', 'Voucher code is removed');
        }

        $voucher = Voucher::where('code', $validated_request['voucher_code'])->first();

        if (!$voucher) {
            return redirect()->back()->with('error', 'Voucher code is invalid');
        }

        Auth::user()->cart->voucher_id = $voucher->id;
        Auth::user()->cart->save();

        return redirect()->back()->with('success', 'Voucher has been successfully applied');
    }

    public function getVoucher(Voucher $voucher)
    {
        Auth::user()->cart->voucher_id = $voucher->id;
        Auth::user()->cart->save();

        return view('user.voucher', [
            'voucher' => $voucher
        ]);
    }

    public function storeCreatedVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:vouchers,code',
            'discount' => 'required|numeric|min:0',
            'min_price' => 'required|numeric|min:0',
            'max_discount' => 'required|numeric|min:0',
            'expired_at' => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
        ]);
        $voucherData = [
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'min_price' => $request->input('min_price'),
            'max_discount' => $request->input('max_discount'),
            'expired_at' => $request->input('expired_at'),
            'quantity' => $request->input('quantity'),
        ];
        
        Voucher::create($voucherData);

        return redirect()->route('admin-voucher.page')->with('success', 'Voucher has been successfully created');
    }

    public function updateVoucher(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:vouchers,code,' .$voucher->id,
            'discount' => 'required|numeric|min:0',
            'min_price' => 'required|numeric|min:0',
            'max_discount' => 'required|numeric|min:0',
            'expired_at' => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
        ]);

        $voucherData = [
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'min_price' => $request->input('min_price'),
            'max_discount' => $request->input('max_discount'),
            'expired_at' => $request->input('expired_at'),
            'quantity' => $request->input('quantity'),
        ];

        $voucher->update($voucherData);

        return redirect()->route('admin-voucher.page')->with('success', 'Voucher with id ' . $voucher->id . ' has been successfully updated');
    }

    public function createVoucher()
    {
        return view('admin.createVoucher');
    }

    public function deleteVoucher(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()->route('admin-voucher.page')->with('success', 'Voucher with id ' . $voucher->id . ' has been successfully deleted');
    }
}
