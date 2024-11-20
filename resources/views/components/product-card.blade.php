<div class="mb-3 col-6 col-md-4 col-xl-3 col-xxl-2">
    <div class="card p-0 pb-3 w-100">

        <a href="{{ route('product-detail.page', ['product' => $product]) }}">
            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
        </a>
        <div class="card-body d-flex flex-column pb-5 pb-md-0 justify-content-between gap-1 gap-sm-3">
            <div>
                <p class="card-text m-0 text-muted">
                    {{ $product->weight }}gr
                </p>
                <h5 class="card-title mt-0 text-truncate">{{ $product->name }}</h5>
                <div class="d-flex flex-row align-items-center justify-content-start gap-2 m-0">
                    <i class="fa-solid fa-star" style="color: var(--accent-yellow);"></i>
                    <p class="card-text m-0 text-center text-muted">
                        {{ number_format($product->rating, 1) }}
                    </p>

                    <i class="fa-solid fa-circle text-muted" style="font-size: 0.3rem;"></i>
                    <p class="card-text m-0 text-center text-muted">
                        {{ $product->total_sold }} sold
                    </p>
                </div>
            </div>

            <div>
                <h4 class="fw-bold">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h4>
            </div>


            @auth
                <form
                    action="{{ route('add-to-cart.action', [
                        'cart' => Auth::user()->cart,
                        'product' => $product,
                    ]) }}"
                    method="POST" class="p-3 m-2 m-sm-3 position-absolute rounded-circle overflow-hidden ratio-1x1 ratio"
                    style="width: 2.5rem; right: 0; bottom: 0;">
                    @csrf
                    <button type="submit" class="btn w-100" style="background-color: var(--accent-yellow); color: white">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>
            @endauth

            @guest
                <div class="p-3 m-2 m-sm-3 position-absolute rounded-circle overflow-hidden ratio-1x1 ratio"
                    style="width: 2.5rem; right: 0; bottom: 0;">
                    <a href="{{ route('login.page') }}" class="btn w-100" style="background-color: var(--accent-yellow); color: white">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            @endguest
        </div>
    </div>
</div>
