@extends('app')

@section('content')
    <div class="row d-flex justify-content-center pt-3">
        @if (session('message'))
            <div class="alert alert-success alert-dismissable fade show m-3 d-flex" role="alert"
                style="position: fixed; top: 0; right:0;width:auto;">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-2">
        </div>
        <div class="col-8">
            <h1 class="pb-2">Create Product</h1>
            <form action="{{ route('create.product.action') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nameInput" placeholder="Contoh : Anggur" name = "name">
                </div>
                <div class="mb-3">
                    <label for="skuInput" class="form-label">SKU</label>
                    <input type="text" class="form-control" id="skuInput" placeholder="Contoh : BUAH-001"
                        name = "sku">
                </div>
                <div class="mb-3">
                    <label for="categoryInput" class="form-label">Choose a category</label>
                    <select class="form-select" id="categoryInput" name="dropdownOption">
                        <option selected disabled>Select an option</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formImage" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formImage" name = "image">
                </div>
                <div class="mb-3">
                    <label for="stockInput" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stockInput" placeholder="Contoh : 20" name = "stock"
                        min="1" max="99999">
                </div>
                <div class="mb-3">
                    <label for="minimumBuyInput" class="form-label">Minimum Buy</label>
                    <input type="number" class="form-control" id="minimumBuyInput" placeholder="Contoh : 1"
                        name = "minimum_buy" min="1" max="99999">
                </div>
                <div class="mb-3">
                    <label for="weightInput" class="form-label">Weight/1pcs</label>
                    <input type="number" class="form-control" id="weightInput" placeholder="In Grams (G)" name = "weight">
                </div>
                <div class="mb-3">
                    <label for="priceInput" class="form-label">Price/1pcs</label>
                    <input type="number" class="form-control" id="priceInput" placeholder="In Rupiah (Rp)" name="price">
                </div>
                <div class="mb-3">
                    <label for="descriptionInput" class="form-label">Description</label>
                    <textarea class="form-control" id="descriptionInput" rows="3" name ="description"
                        placeholder="Contoh : Full natural"></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
@endsection
