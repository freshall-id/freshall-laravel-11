<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'total_price' => $cart->total_price + $product->price
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
            'total_price' => $cart->total_price + $product->price
        ]);

        return redirect()->back();
    }

    public function viewCartPage() 
    {
        $cart = Auth::user()->cart;
        
        return view('sections.user.cart', [
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
            'total_price' => $cart_item->cart->total_price + ($cart_item->product->price * ($status == "increase" ? 1 : -1))
        ]);

        return redirect()->back();
    }

    public function deleteCartItem(CartItem $cart_item) 
    {
        $cart_item->delete();

        $cart_item->cart->update([
            'total_price' => $cart_item->cart->total_price - ($cart_item->product->price * $cart_item->quantity)
        ]);

        return redirect()->back();
    }
}
