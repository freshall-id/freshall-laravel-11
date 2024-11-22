<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Static\PaymentMethod;
use App\Models\Static\ShippingProvider;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addToCart(Cart $cart, Product $product)
    {
        if($cart->cartItems->where('product_id', $product->id)->count() > 0) {
            $cart_item = $cart->cartItems->where('product_id', $product->id)->first();
            $cart_item->update([
                'quantity' => $cart_item->quantity + 1
            ]);

            $cart->update([
                'price_total' => $cart->price_total + $product->price
            ]); 

            return redirect()->back();
        }

        CartItem::create([
            'product_id' => $product->id,
            'cart_id' => $cart->id,
            'quantity' => 1,
            'price' => $product->price,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ]);

        $cart->update([
            'price_total' => $cart->price_total + $product->price
        ]);

        return redirect()->back();
    }

    public function viewCartPage() 
    {
        $cart = Auth::user()->cart;
        
        return view('user.cart', [
            'cart' => $cart
        ]);
    }

    public function updateCartItem(CartItem $cart_item, string $status) 
    {
        if($status != "increase" && $status != "decrease") {
            return redirect()->with('error', 'Status must be either "increase" or "decrease"');
        }
        
        if($status == "increase") {
            if($cart_item->product->stock < $cart_item->quantity + 1) {
                return redirect()->back()->with('error', 'Product stock is not enough');
            }
            $cart_item->update([
                'quantity' => $cart_item->quantity + 1
            ]);
        } else {
            if($cart_item->quantity == 1) {
                $cart_item->delete();
                return redirect()->back();
            }   
            $cart_item->update([
                'quantity' => $cart_item->quantity - 1
            ]);
        }

        $cart_item->cart->update([
            'price_total' => $cart_item->cart->price_total + ($cart_item->product->price * ($status == "increase" ? 1 : -1))
        ]);

        return redirect()->back();
    }

    public function deleteCartItem(CartItem $cart_item) 
    {
        $cart_item->delete();

        $cart_item->cart->update([
            'price_total' => $cart_item->cart->price_total - ($cart_item->product->price * $cart_item->quantity)
        ]);

        return redirect()->back();
    }

    public function decrementCartItem(CartItem $cart_item)
    {
        if($cart_item->quantity == 1) {
            $cart_item->delete();
            return redirect()->back();
        }

        $cart_item->quantity = $cart_item->quantity - 1;
        $cart_item->save();

        return redirect()->back();
    }

    public function incrementCartItem(CartItem $cart_item)
    {
        if($cart_item->product->stock < $cart_item->quantity + 1) {
            return redirect()->back()->with('error', 'Product stock is not enough');
        }

        $cart_item->quantity = $cart_item->quantity + 1;
        $cart_item->save();

        return redirect()->back();
    }

    public function deleteCartItems(Request $request)
    {
        dd($request->all());
    }

    public function viewCheckoutPage()
    {
        $cart = Auth::user()->cart;

        return view('user.checkout', [
            'cart' => $cart,
            'shipping_providers' => ShippingProvider::$shipping_providers,
            'payment_methods' => PaymentMethod::$payment_methods,
        ]);
    }

    public function updateShippingProvider(Request $request)
    {
        $validated_request = $request->validate([
            'shipping_provider' => 'required|integer'
        ]);

        $cart = Auth::user()->cart;
        $shipping_provider = ShippingProvider::getShippingProviderById($validated_request["shipping_provider"]);

        $cart->shipping_provider = $shipping_provider['name'];
        $cart->price_shipping = $shipping_provider['price'];
        $cart->save();

        return redirect()->back();
    }

    public function checkout(Request $request){
        $validated_request = $request->validate([
            'address' => 'required|integer|exists:user_addresses,id',
            'shipping_provider' => 'required|integer',
            'notes' => 'nullable|string',
            'payment_method' => 'required|integer',
        ]);

        $cart = Auth::user()->cart;
        $shipping_provider = ShippingProvider::getShippingProviderById($validated_request['shipping_provider']);
        $payment_method = PaymentMethod::getPaymentMethodById($validated_request['payment_method']);

        try {
            DB::beginTransaction();

            # make transaction
            $transaction_header = TransactionHeader::create([
                'invoice_number' => 'INV/' . time(),
                'status' => 'INPROCESS',
                'shipping_provider' => $shipping_provider['name'],
                'shipping_receipt_number' => Str::upper($shipping_provider['name']) . '/' . time(),
                'shipping_status' => 'INPROCESS',
                'payment_method' => $payment_method['name'],
                'payment_receipt_number' => Str::upper($payment_method['name']) . '/' . time(),
                'payment_status' => 'WAITING',
                'price_shipping' => $shipping_provider['price'],
                'price_items' => $cart->totalItemPrice(),
                'price_discount' => $cart->totalDiscountPrice(),
                'price_insurance' => $cart->totalInsurancePrice(),
                'price_fee' => $cart->price_fee,
                'price_total' => $cart->totalPrice(),
                'notes' => $validated_request['notes'],
                'user_id' => Auth::user()->id,
                'user_address_id' => $validated_request['address'],
                'voucher_id' => $cart->voucher_id,
            ]);
    
            $cart->cartItems->each(function($cart_item) use ($transaction_header) {
                TransactionDetail::create([
                    'transaction_header_id' => $transaction_header->id,
                    'product_id' => $cart_item->product_id,
                    'quantity' => $cart_item->quantity,
                ]);
            });
            
            # empty cart items
            $cart->cartItems()->delete();
            
            # empty cart
            $cart->shipping_provider = null;
            $cart->payment_method = null;
            $cart->voucher_id = null;
            $cart->save();

            DB::commit();
        } catch(\Exception $e) {
            
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Failed to checkout');
        }
        
        return redirect()->route('dashboard.page')->with('success', 'Checkout success');
    }
}
