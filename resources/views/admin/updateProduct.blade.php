@extends('layouts.admin')

@section('content')
    <div class="row d-flex justify-content-center g-5 pt-4">
        <div class="col-2 d-flex justify-content-end">
            <div>
                <a href="{{ route('admin-product.page') }}" class="btn mt-2" style="height: 30px">
                    <i class="fa-solid fa-arrow-left fa-2xl mt-2"></i>
                </a>
            </div>
        </div>
        <div class="col-8 border border-3 rounded shadow py-3">
            <h1 class="pb-2">Update Product</h1>
            <form action="{{ route('update-product.action', ['product' => $product]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nameInput" placeholder="Contoh : Anggur" name = "name"
                        value="{{ old('name', $product->name) }}" data-original-value="{{ $product->name }}">
                </div>
                <div class="mb-3">
                    <label for="skuInput" class="form-label">SKU</label>
                    <input type="text" class="form-control" id="skuInput" placeholder="Contoh : BUAH-001" name = "sku"
                        value="{{ old('sku', $product->sku) }}" data-original-value="{{ $product->sku }}">
                </div>
                <div class="mb-3">
                    <label for="categoryLabelInput" class="form-label">Choose a category label</label>
                    <select class="form-select" id="categoryLabelInput" name="categoryLabel"
                        data-original-value="{{ $product->productCategory->label }}">
                        {{-- <option selected>OTHER</option> --}}
                        @foreach (['OTHER', 'VEGETABLE', 'MEAT', 'FRUIT'] as $categoryLabel)
                            <option value="{{ $categoryLabel }}" @selected(old('categoryLabel', $product->productCategory->label) == $categoryLabel)>{{ $categoryLabel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="categoryNameInput" class="form-label">Choose a category name</label>
                    <select class="form-select" id="categoryNameInput" name="categoryName"
                        data-original-value="{{ $product->productCategory->id }}">
                        <option selected disabled>Select name category</option>
                        {{-- Default name selection based on 'OTHER' --}}
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name = "image" value="{{ old('image') }}">
                </div>
                <div class="mb-3">
                    <label for="stockInput" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stockInput" placeholder="Contoh : 20" name = "stock"
                        min="1" max="99999" value="{{ old('stock', $product->stock) }}"
                        data-original-value="{{ $product->stock }}">
                </div>
                <div class="mb-3">
                    <label for="minimumBuyInput" class="form-label">Minimum Buy</label>
                    <input type="number" class="form-control" id="minimumBuyInput" placeholder="Contoh : 1"
                        name = "minimum_buy" min="1" max="99999"
                        value="{{ old('minimum_buy', $product->minimum_buy) }}"
                        data-original-value="{{ $product->minimum_buy }}">
                </div>
                <div class="mb-3">
                    <label for="weightInput" class="form-label">Weight/1pcs</label>
                    <input type="number" class="form-control" id="weightInput" placeholder="In Grams (G)" name = "weight"
                        value="{{ old('weight', $product->weight) }}" data-original-value="{{ $product->weight }}">
                </div>
                <div class="mb-3">
                    <label for="priceInput" class="form-label">Price/1pcs</label>
                    <input type="number" class="form-control" id="priceInput" placeholder="In Rupiah (Rp)" name="price"
                        value="{{ old('price', $product->price) }}" data-original-value="{{ $product->price }}">
                </div>
                <div class="mb-3">
                    <label for="descriptionInput" class="form-label">Description</label>
                    <textarea class="form-control" id="descriptionInput" rows="3" name ="description"
                        placeholder="Contoh : Full natural" data-original-value="{{ $product->description }}">{{ old('description', $product->description) }}</textarea>
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
        const labelInput = document.getElementById('categoryLabelInput');
        const nameInput = document.getElementById('categoryNameInput');

        // If exist retrieve old values, else OTHER  for name selection
        const oldCategoryName = @json(old('categoryName', $product->productCategory->name));

        function updateNameOptions(selectedLabel, oldValue = null) {

            // Reset nameInput options
            nameInput.innerHTML = '<option selected disabled>Select name category</option>';
            nameInput.disabled = true;

            const categories = @json($categories);

            if (selectedLabel) {
                const filteredCategories = categories.filter(category => category.label === selectedLabel);

                if (filteredCategories.length > 0) {
                    //Case matching categories
                    // Populate dropdown with filtered categories
                    filteredCategories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;

                        // Set the old value as selected
                        if (oldValue && category.name === oldValue) {
                            option.selected = true;
                        }

                        nameInput.appendChild(option);
                    });

                    nameInput.disabled = false;
                } else {
                    // Case no matching categories
                    const noDataOption = document.createElement('option');
                    noDataOption.disabled = true;
                    noDataOption.selected = true;
                    noDataOption.textContent = `No category names available for ${selectedLabel} label`;
                    nameInput.appendChild(noDataOption);
                }
            }
        }

        labelInput.addEventListener('change', function() {
            updateNameOptions(this.value, oldCategoryName);
        });

        // Trigger the function on page load to handle old values
        updateNameOptions(labelInput.value, oldCategoryName);

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

        const imageInput = document.getElementById('image');
        imageInput.addEventListener('change', function() {
            submitButton.disabled = false;
        });

        // Initial check
        checkChanges();
    });
</script>
