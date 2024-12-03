@extends('layouts.admin')

@section('content')
    <div class="my-5">
        <h2 class="fw-bold">Manage Product</h2>
    </div>
    <a href="{{ route('create.product.page') }}" class="mb-3 btn btn-primary">Create New Product</a>
    <div class="d-none d-md-flex flex-sm-row justify-content-between mb-3 flex-wrap">
        @foreach ($categoriesLabel as $label)
            <div>
                @if ($selected == $label)
                    <a href=""
                        class="text-decoration-none fw-bold w-100 mr-1 text-dark cursor-not-allowed border-2 border-black bg-none px-2 py-1 text-sm font-medium">
                        {{ $label }}
                    </a>
                @else
                    <a href="{{ route('admin-product.page', array_merge(request()->query(), ['selected' => $label], ['page' => 1])) }}"
                        class="w-100 text-decoration-none text-dark mr-1 border-2 border-black px-2 py-1 text-sm font-medium hover:opacity-60">
                        {{ $label }}
                    </a>
                @endif
            </div>
        @endforeach
    </div>
    <!-- Select for mobile -->
    <div class="d-md-none mb-3">
        <div>
            <select class="form-select" onchange="location = this.value" aria-label="label Selection">
                @foreach ($categoriesLabel as $label)
                    <option
                        value="{{ $selected == $label ? '' : route('admin-product.page', array_merge(request()->query(), ['selected' => $label], ['page' => 1])) }}"
                        {{ $selected == $label ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <x-product-table :products="$products" />
@endsection
