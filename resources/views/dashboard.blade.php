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
                <button class="carousel-control-prev" type="button" data-bs-target="#promotionCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promotionCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section class="mt-3 gap-5">
        <div class="pt-3 pt-sm-5">
            <h5 class="text-muted">
                <small>
                    Find exactly what you need
                </small>
            </h5>
            <h2>Fresh Categories</h2>
        </div>
        <div class="mt-4 d-flex flex-row gap-4 overflow-auto">
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
            <h5 class="text-muted">
                <small>
                    Quickly locate the products you're looking for
                </small>
            </h5>
            <h2>Explore Subcategories</h2>
        </div>
        <div class="mt-4 d-flex flex-row gap-4 overflow-auto">
            <div class="d-flex flex-row gap-5">
                @foreach ($product_categories as $category)
                <div class="d-flex flex-column gap-3 align-items-center justify-content-center">
                    <div class="ratio ratio-1x1 border rounded-circle overflow-hidden" style="width: 5rem;">
                        <a href="">
                            <img src="{{ asset($category->image) }}" class="w-100 h-100" alt="FRESHALL-CATEGORY-FRUITS">
                        </a>
                    </div>
                    <h6 class="text-muted">{{ $category->name }}</h6>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-3 gap-5">
        <div class="pt-3 pt-sm-5">
            <h5 class="text-muted">
                <small>
                    Save more with the best vouchers available!
                </small>
            </h5>
            <h2>Voucher Offers</h2>
        </div>
        <div class="mt-4 d-flex flex-row gap-4 overflow-auto scrollbar-none">
            <div class="d-flex flex-row gap-5">
                @foreach ($vouchers as $voucher)
                    <div class="card" style="width: 20rem">
                        <div class="card-header" style="background: var(--background)">
                            {{ $voucher->discount * 10 }}% Off on All Items, up to Rp. {{ round($voucher->max_discount,0) }}
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p>CODE: <b>{{ $voucher->code }}</b></p>
                            <footer class="blockquote-footer">Until {{ $voucher->expired_at }}</footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="mt-5">
        <div class="pt-5">
            <h5 class="text-muted">
                <small>
                    Explore our selection of hand-picked fruits, vegetables, and quality meats for your healthiest meals.
                </small>
            </h5>
            <h2>Farm Fresh Produce Delivered to Your Door</h2>
        </div>
        <div class="my-4 mb-2 rounded-5 d-flex flex-row align-items-center justify-content-between w-100">
            <div class="d-inline-flex flex-row align-items-center" style="background-color: var(--background);">
                <a href="!#" class="m-0 text-reset text-decoration-none btn btn-primary">
                    <i class="fa-solid fa-arrow-down-z-a text-white"></i>
                </a>

                <a href="#!" class="m-0 text-reset text-decoration-none btn filter">
                    <i class="fa-solid fa-arrow-up-z-a text-white"></i>
                </a>
            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter by <b>Price</b>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Price</a></li>
                        <li><a class="dropdown-item" href="#">Rating</a></li>
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
    <br>
    
    {{ $products->links() }}
</section>
@endsection