@extends('layouts.admin')

@section('content')
    <div class="row d-flex justify-content-center g-5 pt-4">
        <div class="col-2 d-flex justify-content-end">
            <div>
                <a href="{{ url()->previous() }}" class="btn mt-2" style="height: 30px">
                    <i class="fa-solid fa-arrow-left fa-2xl mt-2"></i>
                </a>
            </div>
        </div>
        <div class="col-8 border border-3 rounded shadow py-3">
            <h1 class="pb-2">Create Voucher</h1>
            <form action="{{ route('create.voucher.action') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="codeInput" class="form-label">Code</label>
                    <input type="text" class="form-control" id="codeInput" placeholder="Contoh : VOUC123" name = "code"
                        value="{{ old('code') }}">
                </div>
                <div class="mb-3">
                    <label for="discountInput" class="form-label">Discount</label>
                    <input type="decimal" class="form-control" id="discountInput" placeholder="Contoh : 2.7" name = "discount"
                        value="{{ old('discount') }}">
                </div>
                <div class="mb-3">
                    <label for="minPriceInput" class="form-label">Minimum Price</label>
                    <input type="number" class="form-control" id="minPriceInput" placeholder="Contoh : 5000.00" name = "min_price"
                        value="{{ old('min_price') }}">
                </div>
                <div class="mb-3">
                    <label for="maxDiscountInput" class="form-label">Maximum Discount</label>
                    <input type="number" class="form-control" id="maxDiscountInput" placeholder="Contoh : 10000.00" name = "max_discount"
                        value="{{ old('max_discount') }}">
                </div>
                <div class="mb-3">
                    <label for="expiredAtInput" class="form-label">Expired Date</label>
                    <input type="datetime" class="form-control" id="expiredAtInput" placeholder="Contoh: 12-12-2024 23:59:59" name = "expired_at"
                        value="{{ old('expired_at') }}">
                </div>
                <div class="mb-3">
                    <label for="quantityInput" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantityInput" placeholder="Contoh : 20" name = "quantity"
                        min="1" max="99999" value="{{ old('quantity') }}">
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
        <div class="col-2 d-none d-sm-block">
        </div>
    </div>
@endsection
