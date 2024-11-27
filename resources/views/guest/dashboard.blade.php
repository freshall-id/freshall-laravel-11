@extends('layouts.dashboard')

@section('content')
    @auth
        @if (Auth::user()->cart->cartItems->count() > 0)
            <a href="{{ route('cart.page') }}" class="position-relative">
                <div class="position-fixed d-none d-sm-block text-light m-2 rounded row z-max p-2 shadow"
                    style="background-color: var(--accent-yellow); right: 0.5rem; bottom: 0.5rem;">
                    <i class="fa-solid fa-bag-shopping d-flex align-items-center justify-content-center p-0 m-0"
                        style="font-size: 2rem; width: 3rem; height: 3rem;"></i>
                    <span class="position-absolute bg-danger p-0"
                        style="width: 0.8rem; aspect-ratio: 1/1; border-radius: 100%; right: 0.6rem; top: 1rem;">
                    </span>
                </div>
            </a>
        @endif
    @endauth

    <section>
        {{-- carousel --}}
        <section class="py-sm-2 p-0 m-0">
            <div id="promotionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{ asset('freshall/promotion-banner-1.png') }}" class="d-block w-100" alt="promotion-1">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="{{ asset('freshall/promotion-banner-2.png') }}" class="d-block w-100" alt="promotion-2">
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#promotionCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#promotionCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        {{-- product categories by label --}}
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
                    @php
                        $labels = [
                            [
                                'label' => 'FRUIT',
                                'name' => 'Fruits',
                                'image' => 'freshall/app/fruits.jpg',
                            ],
                            [
                                'label' => 'VEGETABLE',
                                'name' => 'Vegetables',
                                'image' => 'freshall/app/vegetables.png',
                            ],
                            [
                                'label' => 'MEAT',
                                'name' => 'Meats',
                                'image' => 'freshall/app/meats.png',
                            ],
                            [
                                'label' => 'OTHER',
                                'name' => 'Others',
                                'image' => 'freshall/app/others.png',
                            ],
                        ];
                    @endphp

                    @foreach ($labels as $label)
                        <div class="ratio ratio-1x1 border" style="width: 14rem;">
                            <div class="position-absolute w-100 h-100 top-0 start-0">
                                <img src="{{ asset($label['image']) }}" class="w-100 h-100"
                                    alt="FRESHALL-CATEGORY-{{ $label['label'] }}">
                            </div>
                            <div class="bg-opacity-20 d-flex flex-col align-items-center justify-content-center px-2">
                                <a href="{{ route('product-category-by-label.page', ['label' => $label['label']]) }}"
                                    class="btn btn-primary position-absolute w-75 d-flex justify-content-between align-items-center"
                                    style="bottom: 1rem;">
                                    {{ $label['name'] }}
                                    <i class="fa-solid fa-arrow-right text-white"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- product categories  --}}
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
                                <a href="{{ route('product-category-by-category.page', ['category' => $category]) }}">
                                    <img src="{{ asset($category->image) }}" class="w-100 h-100"
                                        alt="FRESHALL-CATEGORY-FRUITS">
                                </a>
                            </div>
                            <h6 class="text-muted">{{ $category->name }}</h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- voucher --}}
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
                        <div style="width: 20rem">
                            <x-voucher-card :voucher="$voucher" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- products --}}
        <section class="mt-5">
            <div class="pt-5">
                <h5 class="text-muted">
                    <small>
                        Explore our selection of hand-picked fruits, vegetables, and quality meats for your healthiest
                        meals.
                    </small>
                </h5>
                <h2>Farm Fresh Produce Delivered to Your Door</h2>
            </div>

            <div class="mt-4 mb-3"></div>
            <div class="mt-4">
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
