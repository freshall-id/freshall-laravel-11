<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FRESHALL | Fresh Groceries, Delivered with Care</title>
    
    <link rel="icon" href="{{ asset('freshall/logo-light-mode.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-utilities.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    @include('components.alert')
    <div class="container">
        <section class="mt-5">
            <div>
                <h5 class="text-muted">
                    <small>
                        Complete your purchase by filling in the form below
                    </small>
                </h5>
                <div class="d-flex align-items-center gap-3 text-center">
                    <img src="{{ asset('freshall/logo-light-mode.svg') }}" alt="FRESHALL_LOGO" style="width: 3rem;">
                    <h2 class="m-0 p-0">Checkout</h2>
                </div>
            </div>
        </section>

        <section class="my-3 py-3">
            <div class="mt-3 row"> 
                <div class="col-12 col-md-7">

                    {{-- review order --}}
                    <div class="p-3 border">
                        <h5>Review Order <span class="text-danger">*</span></h5>
                        <div class="container d-flex flex-column gap-4">
                            @foreach ($cart->cartItems as $cartItem)
                                <div class="row">
                                    <div class="col-2 p-0 m-0">
                                        <img src="{{ asset($cartItem->product->image) }}" alt="PRODUCT_IMAGE" class="img-fluid">
                                    </div>
                                    <div class="col-10">
                                        <h6 class="fw-normal">
                                            {{ $cartItem->product->name }} - {{ $cartItem->product->weight }}gr
                                        </h6>
                                        <h6 class="fw-bold">
                                            Rp. {{ number_format($cartItem->product->price, 0, ",", ".") }}
                                        </h6>
                                        <div class="mt-3 d-flex flex-column">
                                            <label for="quantity">
                                                Quantity 
                                            </label>
                                            <input type="number" name="quantity" id="quantity" value="{{ $cartItem->quantity }}" class="form-control mt-2 w-25 d-inline" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                        </div>
                    </div>

                    {{-- ship to --}}
                    <div class="p-3 border mt-3">
                        <h5>Ship to <span class="text-danger">*</span></h5>
                        <div class="container p-0">
                            <div class="p-0 m-0">
                                @isset($userAddresses)
                                    <select class="form-select" aria-label="Shipping Address" required>
                                        <option selected>Select Address</option>
                                        @foreach ($userAddresses as $address)
                                            <option value="{{ $address->id }}" class="text-truncate">
                                                <h6 class="text-truncate">
                                                    {{ $address->label }} - {{ $address->full_address }}
                                                </h6>
                                            </option>
                                        @endforeach
                                    </select>
                                @endisset
                                
                                @empty($userAddresses)
                                    <div class="alert alert-info mt-2">
                                        You have no address yet
                                    </div>
                                    <a href="" class="btn btn-primary">
                                        Add Address
                                    </a>
                                @endempty
                            </div>
                            <div class="mt-3">
                                <h6 class="text-muted">Delivery</h6>
                                @empty($shipping_providers)
                                    <div class="alert alert-info mt-2">
                                        No shipping provider available
                                    </div>
                                @endempty

                                @isset($shipping_providers)
                                <form action="{{ route('update-shipping-provider.action') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @foreach($shipping_providers as $shipping_provider)
                                        <div class="mt-2 d-flex flex-row">
                                            <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="shipping_provider" 
                                                id="{{ $shipping_provider["id"] }}" 
                                                value="{{ $shipping_provider["id"] }}"
                                                @if ($shipping_provider["name"] == $cart->shipping_provider)
                                                    checked
                                                @endif
                                            >
                                            <label class="form-check-label ms-2" for="{{ $shipping_provider["id"] }}">
                                                {{ $shipping_provider["name"] }} - Rp. {{ number_format($shipping_provider["price"], 0, ",", ".") }}
                                            </label>
                                        </div>
                                    @endforeach

                                    <button type="submit" class="mt-3 btn btn-primary">
                                        Update Shipping
                                    </button>
                                </form>
                                @endisset
                            </div>
                        </div>
                    </div>
                    
                    {{-- voucher --}}
                    <div class="p-3 border mt-3">
                        <h5>Voucher</h5>
                        @isset($cart->voucher)
                            <x-voucher-card :voucher="$cart->voucher"/>
                        @endisset
                        <form action="{{ route('use-voucher.action') }}" method="POST" class="container p-0 mt-2">
                            @csrf
                            @method('PUT')
                            <input value="{{ $cart->voucher->code ?? '' }}" type="text" name="voucher_code" id="voucher_code" class="form-control" placeholder="Enter your voucher code here">
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Apply Voucher
                                </button>
                            </div>
                        </form> 
                    </div>
    
                    {{-- order notes --}}
                    <div class="p-3 border mt-3">
                        <h5>Order Notes</h5>
                        <div class="container p-0">
                            <textarea name="order_notes" id="order_notes" cols="30" rows="10" class="form-control resize-none" placeholder="Write your notes here"></textarea>
                        </div>
                    </div>
                    
                    {{-- pay with --}}
                    <div class="p-3 border mt-3">
                        <h5>Pay with<span class="text-danger">*</span></h5>
                        <div class="container p-0">
                            @forelse ($payment_methods as $payment_method)
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="radio" name="payment_method" id="{{ $payment_method["id"] }}" value="{{ $payment_method["id"] }}">
                                    <label class="form-check-label w-100" for="{{ $payment_method["id"] }}">
                                        <div class="accordion ms-3 accordion-flush border" id="a-{{ $payment_method["id"]}}">
                                            <div class="accordion-item w-100">
                                                <h2 class="accordion-header">
                                                <button class="accordion-button collapsed w-100" type="button" data-bs-toggle="collapse" data-bs-target="#fc-{{ $payment_method["id"]}}" aria-expanded="false" aria-controls="fc-{{ $payment_method["id"]}}">
                                                    <div style="width: 2.5rem;">
                                                        <img src="{{ asset($payment_method["image"]) }}" alt="PAYMENT_METHOD_IMAGE" class="img-fluid">
                                                    </div>
                                                </button>
                                                </h2>
                                                <div id="fc-{{ $payment_method["id"]}}" class="accordion-collapse collapse" data-bs-parent="#a-{{ $payment_method["id"]}}">
                                                <div class="accordion-body">
                                                    {{ $payment_method["guidelines"] }}
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <div class="alert alert-info mt-2">
                                    No payment method available
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="mt-3 mt-md-0 col-12 col-md-5">
                    <div class="p-3 border">
                        <h5>Order Summary</h5>
                        <div class="container mt-3">
                            <div class="d-flex justify-content-between">
                                <h6>Subtotal</h6>
                                <h6>{{ $cart->totalItemPriceToNumberFormat() }} </h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Discount</h6>
                                <h6>- {{ $cart->totalDiscountPriceToNumberFormat() }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Insurance <small class="text-muted">(2%)</small></h6>
                                <h6>{{ $cart->totalInsurancePriceToNumberFormat() }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Shipping</h6>
                                <h6>{{ $cart->shippingPriceToNumberFormat() }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Total</h6>
                                <h6>{{ $cart->totalPriceToNumberFormat() }}</h6>
                            </div>
                        </div>
    
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>

              
            </div>
        </section>
    </div>
</body>
<script src="{{ asset('index.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.esm.min.js') }}"></script>
</html>
