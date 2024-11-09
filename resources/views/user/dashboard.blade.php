@extends('app')

@section('content')
    <x-cart-status />
    <section>
        <section class="py-sm-2 p-0 m-0">
            <div id="promotionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{ asset('freshall/promotion-banner-1.png') }}" class="d-block w-100" alt="promotion-1">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="{{ asset('freshall/promotion-banner-2.png') }}" class="d-block w-100" alt="promotion-2">
                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#promotionCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promotionCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        @if (Auth::check())
            <section class="mt-3">
                <div class="pt-3 pt-sm-5">
                    <h2>Transaction</h2>
                </div>
                @if (!$transactions || $transactions->isEmpty())
                    <div class="alert alert-warning mt-3" role="alert">
                        You don't have any transaction yet.
                    </div>
                @else
                    <div class="mt-5">
                        @foreach ($transactions as $transaction)
                            <div class="card">
                                <div class="card-header">
                                    {{ $transaction->status}}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $transaction->invoice_number }}</h5>
                                    <p class="card-text">{{ $transaction->total_price }}</p>
                                    <a href="#" class="btn btn-primary">Check Detail</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        @endif

        <section class="mt-3 gap-5">
            <div class="pt-3 pt-sm-5">
                <h2>Fresh Categories</h2>
            </div>
            
            <div class="mt-5 d-flex flex-row gap-4 overflow-auto">
                <div class="d-flex flex-row gap-3">
                    <div class="ratio ratio-1x1 border" style="width: 14rem;">
                        <div class="position-absolute w-100 h-100 top-0 start-0">
                            <img src="{{ asset('freshall/app/fruits.jpg') }}" class="w-100 h-100" alt="FRESHALL-CATEGORY-FRUITS">
                        </div>
                        <div class="bg-opacity-20 d-flex flex-col align-items-center justify-content-center px-2">
                            <a href="" class="btn btn-primary position-absolute w-75 d-flex justify-content-between align-items-center" style="bottom: 1rem;">
                                Fruits
                                <i class="fa-solid fa-arrow-right text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ratio ratio-1x1 border" style="width: 14rem;">
                        <div class="position-absolute w-100 h-100 top-0 start-0">
                            <img src="{{ asset('freshall/app/vegetables.png') }}" class="w-100 h-100" alt="FRESHALL-CATEGORY-FRUITS">
                        </div>
                        <div class="bg-opacity-20 d-flex flex-col align-items-center justify-content-center px-2">
                            <a href="" class="btn btn-primary position-absolute w-75 d-flex justify-content-between align-items-center" style="bottom: 1rem;">
                                Vegetables
                                <i class="fa-solid fa-arrow-right text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ratio ratio-1x1 border" style="width: 14rem;">
                        <div class="position-absolute w-100 h-100 top-0 start-0">
                            <img src="{{ asset('freshall/app/meats.png') }}" class="w-100 h-100" alt="FRESHALL-CATEGORY-FRUITS">
                        </div>
                        <div class="bg-opacity-20 d-flex flex-col align-items-center justify-content-center px-2">
                            <a href="" class="btn btn-primary position-absolute w-75 d-flex justify-content-between align-items-center" style="bottom: 1rem;">
                                Meats
                                <i class="fa-solid fa-arrow-right text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="mt-3 gap-5">
            <div class="pt-3 pt-sm-5">
                <h2>Fresh Categories</h2>
            </div>
            @if (!$product_categories || $product_categories->isEmpty())
                <div class="alert alert-warning mt-3" role="alert">
                    There is no product category yet.
                </div>
            @else
                <div class="mt-5 d-flex gap-4 overflow-auto">
                    @foreach ($product_categories as $product_category)
                        <a class="text-decoration-none text-dark" href="">
                            <div class="p-4 pb-5 text-center rounded" style="width: 10rem; background-color: var(--background)">
                                <img src="{{ asset('default/product_category.png') }}" class="img-fluid" alt="{{ $product_category->name }}">
                                <h1 class="mt-3 fs-5 fw-medium text-black" style="color">{{ $product_category->name }}</h1>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        <section class="mt-5">
            <div class="pt-5">
                <h2>Fresh Products</h2>
            </div>
            @if (!$products || $products->isEmpty())
                <div class="alert alert-warning mt-3" role="alert">
                    There is no product yet.
                </div>
            @else
                <div class="mt-5">
                    <div class="row justify-content-start">
                        @foreach ($products as $product)
                            <div class="mb-3 col-12 col-sm-6 col-md-4 col-xl-3 col-xxl-2">
                                <div class="card p-0 w-100">
                                    <img src="{{ asset('default/product.png') }}" class="card-img-top" alt="{{ $product->name }}">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title text-truncate fw-bold text-muted">{{ $product->name }}</h5>
                                        <p class="card-text text-muted">{{ $product->weight }}gr</p>

                                        <h4 class="text-muted mt-2">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </h4>
                                        @if (Auth::check())
                                            <form 
                                                action="{{ route('add-to-cart.action', [
                                                        'cart' => Auth::user()->cart,
                                                        'product' => $product,
                                                    ]) }}" 
                                                method="POST"
                                                class="w-100 p-0"
                                            >
                                                @csrf
                                                <button type="submit" class="btn w-100" style="background-color: var(--accent-yellow); color: white">
                                                    Add to cart
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
                        @endforeach
                    </div>
                </div>
            @endif

        </section>
        <br>
        
        {{ $products->links() }}
    </section  
@endsection