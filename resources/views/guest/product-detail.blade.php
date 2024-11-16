@extends('app')

@section('content')

<section class="mt-5 row p-0 m-0">
    <div class="col-12 col-md-6 p-3">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name . '_IMAGE'}}" class="img-fluid">
    </div>
    <div class="col-12 col-md-6 p-3 d-flex flex-column justify-content-between">
        <div>
            <div class="d-flex justify-content-between">
                <p class="text-muted p-0">{{ $product->sku }}</p>
                <p class="text-muted m-0">{{ $product->weight }}gr</p>
            </div>
            <h1 class="fw-bold p-0">{{ $product->name }}</h1>
    
            <div class="d-flex flex-row align-items-center gap-2">
                <i class="fa-solid fa-star" style="color: var(--accent-yellow);"></i>
                <p class="m-0 text-muted">{{ number_format($product->rating, 1) }}</p>
                <i class="fa-solid fa-circle text-muted" style="font-size: 0.3rem;"></i>
                <p class="m-0 text-muted">{{ $product->total_sold }} sold</p>
            </div>
    
            <p class="text-muted mt-3">
                {!! $product->description !!}
            </p>
        </div>

        <div>
            <h2 class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

            @if (Auth::check())
                <form 
                    action="{{ route('add-to-cart.action', [
                            'cart' => Auth::user()->cart,
                            'product' => $product,
                        ]) }}" 
                    method="POST"
                    class="mt-3"
                >
                    @csrf
                    <button type="submit" class="btn w-100" style="background-color: var(--accent-yellow); color: white">
                        Add to Cart
                    </button>
                </form>
            @else
                <div class="mt-3">
                    <a href="{{ route('login.page') }}" class="btn w-100"  style="background-color: var(--accent-yellow); color: white">
                        Add to Cart
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
    
@endsection