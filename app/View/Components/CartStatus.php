<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CartStatus extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render() : View|Closure|string
    {
        if(!Auth::check()) {
            return view('components.cart-status', [
                'cart' => null,
                'cart_items' => 0
            ]);
        }

        $user_cart = Auth::user()->cart;

        $cart_items = $user_cart->cartItems->count();

        return view('components.cart-status', [
            'cart' => $user_cart,
            'cart_items' => $cart_items
        ]);
    }
}
