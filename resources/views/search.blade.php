@extends('app')

@section('content')
<section class="mt-5">
    <div class="pt-5">
        <h5 class="text-muted">
            <small>
                Find Exactly What You’re Looking For
            </small>
        </h5>
        <h2>Your Search Result for "{{ request('query')}}"</h2>
    </div>
    <div class="my-4 mb-2 rounded-5 d-flex flex-row align-items-center justify-content-between w-100">
        <div class="d-inline-flex flex-row align-items-center" style="background-color: var(--background);">
            <a href="{{ route('search.page', array_merge(request()->all(), ['asc' => true])) }}" class="m-0 text-reset text-decoration-none btn {{ request('asc') === '1' ? 'btn-primary' : ''}}">
                <i class="fa-solid fa-arrow-up-z-a text-white"></i>
            </a>
            
            <a href="{{ route('search.page', array_merge(request()->all(), ['asc' => false])) }}" class="m-0 text-reset text-decoration-none btn {{ request('asc') === '0' ? 'btn-primary' : ''}}">
                <i class="fa-solid fa-arrow-down-z-a text-white"></i>
            </a>
            
        </div>
        <div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by <b>{{ request('order_by') }}</b>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('search.page', array_merge(request()->all(), ['order_by' => 'price'])) }}">Price</a></li>
                    <li><a class="dropdown-item" href="{{ route('search.page', array_merge(request()->all(), ['order_by' => 'rating'])) }}">Rating</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-top mb-3"></div>
        <div class="mt-3">
            <div class="row justify-content-start">
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="alert alert-warning" role="alert">
                        There is no product yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{ $products->links() }}
    
@endsection