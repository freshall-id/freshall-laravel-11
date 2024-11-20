@extends("layouts.default")

@section("content")

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
                    <a href="{{ route('dashboard.page') }}">
                        <img src="{{ asset('freshall/logo-light-mode.svg') }}" alt="FRESHALL_LOGO" style="width: 3rem;">
                    </a>
                    <h2 class="m-0 p-0">Checkout</h2>
                </div>
            </div>
        </section>

        <section class="my-3 py-3">
            <div class="mt-3 row"> 
                <div class="col-12 col-md-7">
                    
                    {{-- voucher --}}
                    <div class="p-3 border">
                        <h5>Voucher</h5>
                        @isset($cart->voucher)
                            <x-voucher-card :voucher="$cart->voucher"/>
                        @endisset
                        <form action="{{ route('use-voucher.action') }}" method="POST" class="container p-0 mt-2">
                            @csrf
                            <div class="row d-flex align-items-center">
                                <div class="col-9">
                                    <input value="{{ $cart->voucher->code ?? '' }}" type="text" name="voucher_code" id="voucher_code" class="form-control" placeholder="Enter your voucher code here">
                                </div>
                                <div class="text-end col-3">
                                    <button type="submit" class="w-100 btn btn-primary">
                                        Apply Voucher
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div>

                    {{-- review order --}}
                    <div class="p-3 border mt-3">
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
                </div>

                <div class="mt-3 mt-md-0 col-12 col-md-5">
                    <form action="{{ route('checkout.action') }}" method="POST">
                        @csrf
                                        
                        {{-- Deliver to --}}
                        <div class="p-3 border">
                            <h5>Deliver to</h5>
                            <div class="container p-0">
                                <div class="p-0 m-0">
                                    
                                    <h6 class="text-muted">Address <span class="text-danger">*</span></h6>

                                    @isset(Auth::user()->userAddresses)
                                        <select name="address" class="form-select mb-3" aria-label="Shipping Address" required>
                                            <option selected>Select Address <span class="text-danger">*</span></option>
                                            @foreach (Auth::user()->userAddresses as $address)
                                                <option value="{{ $address->id }}" class="text-truncate">
                                                    <h6 class="text-truncate">
                                                        {{ $address->label }} - {{ $address->full_address }}
                                                    </h6>
                                                </option>
                                            @endforeach
                                        </select>
                                    @endisset
                                    
                                    @empty(Auth::user()->userAddresses)
                                        <div class="alert alert-info mt-2">
                                            You have no address yet
                                        </div>
                                    @endempty
                                    
                                    <a href="" class="btn btn-primary">
                                        Edit or Add Address
                                    </a>
                                </div>

                                <div class="mt-3">
                                    <h6 class="text-muted">Delivery</h6>

                                    @forelse ($shipping_providers as $shipping_provider)
                                        <div class="mt-2 d-flex flex-row">
                                            <input 
                                                class="form-check-input shipping_provider_radio" 
                                                type="radio" 
                                                name="shipping_provider" 
                                                id="{{ $shipping_provider["id"] }}" 
                                                value="{{ $shipping_provider["id"] }}"
                                            >
                                            <label class="form-check-label ms-2" for="{{ $shipping_provider["id"] }}">
                                                {{ $shipping_provider["name"] }} - Rp {{ number_format($shipping_provider["price"], 0, ",", ".") }}
                                            </label>
                                        </div>
                                    @empty
                                        <div class="alert alert-info mt-2">
                                            No shipping provider available
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- order notes --}}
                        <div class="p-3 border mt-3">
                            <h5>Order Notes</h5>
                            <label for="notes" class="text-muted">Provide notes for us <small class="text-muted">(optional)</small></label>
                            <div class="container p-0">
                                <textarea name="notes" id="notes" cols="30" rows="5" class="form-control resize-none" placeholder="Write your notes here"></textarea>
                            </div>
                        </div>
                        
                        {{-- pay with --}}
                        <div class="p-3 border mt-3">
                            <h5>Pay with</h5>
                            <h6 class="text-muted">Payment Method <span class="text-danger">*</span></h6>
                            <div class="container d-flex flex-column gap-3 p-0 mt-3">
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

                        {{-- order summary --}}
                        <div class="p-3 border mt-3">
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
                                    <h6 id="shipping_price">Rp 0</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>Fee</h6>
                                    <h6>{{ $cart->priceFeeToNumberFormat() }}</h6>
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
                    </form>  
                </div>

                
            </div>
        </section>
    </div>

    <script>
        const shipping_providers = @json($shipping_providers);
        const shipping_provider_radios = document.querySelectorAll('.shipping_provider_radio');
        const shipping_price = document.getElementById('shipping_price');

        const formatCurrency = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        };

        shipping_provider_radios.forEach(radio => {
            radio.addEventListener('change', (e) => {
                const selected_shipping_provider = shipping_providers.find(sp => sp.id == e.target.value);
                shipping_price.innerText = `${formatCurrency(selected_shipping_provider.price)}`;
            });
        });
    </script>
@endsection
