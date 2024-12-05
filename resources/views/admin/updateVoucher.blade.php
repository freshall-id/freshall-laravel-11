@extends('layouts.admin')

@section('content')
    <div class="row d-flex justify-content-center g-5 pt-4">
        <div class="col-2 d-flex justify-content-end">
            <div>
                <a href="{{ route('admin-voucher.page') }}" class="btn mt-2" style="height: 30px">
                    <i class="fa-solid fa-arrow-left fa-2xl mt-2"></i>
                </a>
            </div>
        </div>
        <div class="col-8 border border-3 rounded shadow py-3">
            <h1 class="pb-2">Update Voucher</h1>
            <form action="{{ route('update-voucher.action', ['voucher' => $voucher]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="codeInput" class="form-label">Code</label>
                    <input type="text" class="form-control" id="codeInput" placeholder="Contoh : VOUC123" name = "code"
                        value="{{ old('code',$voucher->code) }}" data-original-value="{{ $voucher->code }}">
                </div>
                <div class="mb-3">
                    <label for="discountInput" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="discountInput" placeholder="Contoh : 2.7" name = "discount"
                    value="{{ old('discount',$voucher->discount) }}" data-original-value="{{ $voucher->discount }}">
                </div>
                <div class="mb-3">
                    <label for="minPriceInput" class="form-label">Minimum Price</label>
                    <input type="number" class="form-control" id="minPriceInput" placeholder="Contoh : 5000.00" name = "min_price"
                    value="{{ old('min_price',$voucher->min_price) }}" data-original-value="{{ $voucher->min_price }}">
                </div>
                <div class="mb-3">
                    <label for="maxDiscountInput" class="form-label">Maximum Discount</label>
                    <input type="number" class="form-control" id="maxDiscountInput" placeholder="Contoh : 10000.00" name = "max_discount"
                    value="{{ old('max_discount', $voucher->max_discount) }}" data-original-value="{{ $voucher->max_discount }}">
                </div>
                <div class="mb-3">
                    <label for="expiredAtInput" class="form-label">Expired Date</label>
                    <input type="datetime" class="form-control" id="expiredAtInput" placeholder="" name = "expired_at"
                    value="{{ old('expired_at',$voucher->expired_at) }}" data-original-value="{{ $voucher->expired_at }}">
                </div>
                <div class="mb-3">
                    <label for="quantityInput" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantityInput" placeholder="Contoh : 20" name = "quantity"
                        min="1" max="99999" value="{{ old('quantity',$voucher->quantity) }}" data-original-value="{{ $voucher->quantity}}">
                </div>
                <button type="submit" id="submitButton" class="btn btn-warning">Update</button>
            </form>
        </div>
        <div class="col-2 d-none d-sm-block">
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formElements = document.querySelectorAll('[data-original-value]');
        const submitButton = document.getElementById('submitButton');
        const checkChanges = () => {
            let isChanged = false;

            formElements.forEach(element => {
                const originalValue = element.dataset.originalValue;
                const currentValue = element.value;

                if (currentValue !== originalValue) {
                    isChanged = true;
                }
            });

            submitButton.disabled = !isChanged;
        };

        formElements.forEach(input => {
            input.addEventListener('input', checkChanges);
            input.addEventListener('change', checkChanges);
        });

        

        // Initial check
        checkChanges();
    });
</script>