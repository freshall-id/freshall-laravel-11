@extends('layouts.dashboard')

@section('content')
    <section class="mt-5">
        <div class="pt-5">
            <h5 class="text-muted">
                <small>
                    Fresh from the market for you
                </small>
            </h5>
            @isset($label)
                <h2>{{ $label }}</h2>
            @endisset

            @isset($category)
                <h2>{{ $category->name }}</h2>
            @endisset
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
