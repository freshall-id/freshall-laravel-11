<div class="mb-3 col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="card p-0 w-100">

        <img src="{{ asset('default/product.png') }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body d-flex flex-column justify-content-between gap-3">
            <div>
                <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                <p class="card-text text-muted">
                    <i class="fa-solid fa-weight-hanging me-1" style="color: var(--accent-yellow);"></i>
                    {{ $product->weight }}gr
                </p>
            </div>

            <div>
                <h4 class="fw-bold">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h4>
            </div>


            @if (Auth::check())
                <form 
                    action="{{ route('add-to-cart.action', [
                            'cart' => Auth::user()->cart,
                            'product' => $product,
                        ]) }}" 
                    method="POST"
                    class="p-3 m-3 position-absolute rounded-circle overflow-hidden ratio-1x1 ratio"
                    style="width: 2.5rem; right: 0; bottom: 0;"
                >
                    @csrf
                    <button type="submit" class="btn w-100" style="background-color: var(--accent-yellow); color: white">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>
            @else
                <button href="{{ route('login.page') }}" class="btn mt-1" style="background-color: var(--accent-yellow); color: white">
                    Add to cart
                </button>
            @endif
        </div>
    </div>
</div>