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
            
            <div class="mt-5 container-fluid m-0 p-0">
                <div class="row m-0 mb-2">
                    <div class="col-1 border-bottom py-3 text-start">
                        <input type="checkbox" id="select-all-checkbox">
                    </div>
                    <div class="col-5 d-flex align-items-center border-bottom">
                        <h6 class="text-muted fw-bold">PRODUCT</h6>
                    </div>
                    <div class="col-3 d-flex align-items-center border-bottom">
                        <h6 class="d-none d-md-block text-muted fw-bold">QUANTITY</h6>
                    </div>
                    <div class="col-3 d-flex align-items-center border-bottom">
                        <h6 class="d-none d-md-block text-muted fw-bold">PRICE</h6>
                    </div>
                </div>
                @forelse ($cart->cartItems as $cart_item)
                    <div class="row m-0 py-1 border-bottom border-bottom-md-0">
                        <div class="col-1 pt-2 pt-md-0 border-md-bottom pb-2 py-3 text-start">
                            <input type="checkbox" name="{{ $cart_item->id }}">
                        </div>
                        <div class="col-11 col-md-5 container pb-2 d-flex align-items-center border-md-bottom">
                            <div class="row">
                                <div class="overflow-hidden col-md-4">
                                    <img src="{{ asset($cart_item->product->image) }}" alt="{{ $cart_item->product->name }}" class="img-fluid">
                                </div>
                                <div class="col-md-8 pb-1 gap-2 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title mt-0 text-truncate">{{ $cart_item->product->name }}</h5>
                                        <p class="card-text m-0 text-muted">
                                            {{ $cart_item->product->weight }}gr
                                        </p>
                                    </div>
                                    <div class="m-0 p-0">
                                        @if ($cart_item->product->stock < $cart_item->quantity)
                                            <span class="badge text-bg-secondary bg-danger">
                                                Out of Stock
                                            </span>
                                        @elseif ($cart_item->product->stock == $cart_item->quantity)
                                            <span class="badge text bg-secondary bg-warning">
                                                Almost Out of Stock ({{ $cart_item->product->stock }} items left)
                                            </span>
                                        @else
                                            <span class="badge text bg-secondary bg-success">
                                                In Stock ({{ $cart_item->product->stock }} items left)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offset-1 offset-md-0 col-md-3 d-flex pb-2 justify-content-start px-0 align-items-start border-md-bottom">
                            <div>
                                <div class="d-flex flex-row gap-1">       
                                    <form action="{{ route('update-cart-item.decrement.action', ['cart_item' => $cart_item]) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn">
                                            @if ($cart_item->quantity == 1)
                                                <i class="fa-solid fa-trash"></i>
                                            @else
                                                <i class="fa-solid fa-minus"></i>
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <input type="number" value={{ $cart_item->quantity }} class="w-50 p-0 m-0 text-center" disabled>
                                    
                                    <form action="{{ route('update-cart-item.increment.action', ['cart_item' => $cart_item]) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="offset-1 offset-md-0 col-md-3 d-flex pb-2 align-items-start border-md-bottom">
                            <div>
                                <h4 class="">
                                    Rp {{ number_format($cart_item->cartItemPrice(), 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info mt-2">
                        Your cart is empty
                    </div>
                @endforelse
            </div>

        </section>
        @if (!$cart->cartItems->isEmpty())
            <section class="mt-5 w-100 d-flex justify-content-end">
                <form action="" method="POST">
                    @csrf
                    <button class="btn btn-success">
                        Checkout
                    </button>
                </form>
            </section>
        @endif
    </div>

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
    
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[type=checkbox]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    
    </script>
@endsection
