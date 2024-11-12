@extends('app')

@section('content')
    <div>
        <section class="mt-5">
            <div>
                <h5 class="text-muted">
                    <small>
                        Fresh produce is just a step away.
                    </small>
                </h5>
                <h2>Your Basket of Freshness</h2>
            </div>

            <div class="mt-3">
                            
                @if ($cart->cartItems->isEmpty())
                    <div class="alert alert-info mt-2">
                        Your cart is empty
                    </div>
                @else
                    <div class="table-responsive mt-5">
                        <table class="table table-borderless align-middle">   
                            <thead class="bg-transparent border-bottom">
                                <tr class="text-muted">
                                    <th class="w-5"><input type="checkbox"></th>
                                    <th class="w-50">PRODUCT</th>
                                    <th class="w-25">QUANTITY</th>
                                    <th class="w-50">PRICE</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr
                                    class="bg-transparent border-bottom"
                                >
                                    @foreach ($cart->cartItems as $cart_item)
                                        
                                        <th><input type="checkbox"></th>
                                        <td class="d-flex flex-row">
                                            <div class="ratio ratio-1x1" style="width: 8rem">
                                                <img
                                                    src="{{ asset($cart_item->product->image) }}"
                                                    alt="{{ $cart_item->product->name }}"
                                                    class="w-100 h-100"
                                                />
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="text-truncate">{{ $cart_item->product->name }}</h5>
                                                <p class="text-muted text-truncate">{{ Str::words($cart_item->product->description, 10) }} </p>

                                                @if ($cart_item->product->stock < $cart_item->quantity)
                                                    <span class="badge text-bg-secondary bg-danger">
                                                        Out of Stock
                                                    </span>
                                                @elseif ($cart_item->product->stock == $cart_item->quantity)
                                                    <span class="badge text bg-secondary bg-warning">
                                                        Almost Out of Stock ({{ $cart_item->product->stock }} items left)
                                                    </span>
                                                @else
                                                    <p class="badge text bg-secondary bg-success">
                                                        In Stock ({{ $cart_item->product->stock }} items left)
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="quantity-selector">       
                                                <form action="{{ route('update-cart-item.action', ['cart_item' => $cart_item, 'status' => 'decrease']) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit">-</button>
                                                </form>
                                                <input type="number" value={{ $cart_item->quantity }} class="p-0 m-0 text-center" disabled>
                                                
                                                <form action="{{ route('update-cart-item.action', ['cart_item' => $cart_item, 'status' => 'increase']) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit">+</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($cart_item->product->price, 0, ',', '.') }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                    </div>
                @endisset
            </div>

        </section>
        @if (!$cart->cartItems->isEmpty())
            <section class="mt-5 w-100 d-flex justify-content-end">
                <form action="" method="POST">
                    @csrf
                    <button class="btn btn-danger me-2">
                        Delete
                    </button>
                </form>
                <form action="" method="POST">
                    @csrf
                    <button class="btn btn-success">
                        Checkout
                    </button>
                </form>
            </section>
        @endif
    </div>
@endsection

<script>
    function updateQuantity(element, action) {
        let quantityInput = element.parentNode.querySelector('input[name=quantity]');
        if (action === 'increase') {
            quantityInput.stepUp();
        } else if (action === 'decrease') {
            quantityInput.stepDown();
        }

        element.closest('form').submit();
    }

</script>