@extends('layouts.admin')

@section('content')
    <div class="row d-flex justify-content-center g-2 g-md-5 pt-4">
        <div class="col-1 col-md-2 d-flex justify-content-end">
            <div>
                <a href="{{ route('admin-productCategory.page') }}" class="btn mt-2" style="height: 30px">
                    <i class="fa-solid fa-arrow-left fa-2xl mt-2"></i>
                </a>
            </div>
        </div>
        <div class="col-9 col-md-8 border border-3 rounded shadow py-3 px-3">
            <h1 class="pb-2">Update Product Category</h1>
            <form action="{{ route('update-productCategory.action', ['productCategory' => $productCategory]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="labelInput" class="form-label">Choose a category label</label>
                    <select class="form-select" id="labelInput" name="label"
                        data-original-value="{{ $productCategory->label }}">
                        {{-- <option selected>OTHER</option> --}}
                        @foreach (['OTHER', 'VEGETABLE', 'MEAT', 'FRUIT'] as $categoryLabel)
                            <option value="{{ $categoryLabel }}" @selected(old('label', $productCategory->label) == $categoryLabel)>{{ $categoryLabel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Choose a category name</label>
                    <input type="text" class="form-control" id="nameInput" placeholder="Contoh : Anggur" name = "name"
                        value="{{ old('name', $productCategory->name) }}" data-original-value="{{ $productCategory->name }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <div class="ratio ratio-1x1 mb-3" id="preview_image_container">
                        <img class="img-thumbnail" id="preview_image" src="{{ asset($productCategory->image) }}" alt="productCategory Picture">
                    </div>
                    <input class="form-control" type="file" id="image" name = "image" value="{{ old('image') }}" onchange="updatePreviewImage(event)">
                </div>
                <div class="mb-3">
                    <label for="descriptionInput" class="form-label">Description</label>
                    <textarea class="form-control" id="descriptionInput" rows="3" name ="description"
                        placeholder="Contoh : Full natural" data-original-value="{{ $productCategory->description }}">{{ old('description', $productCategory->description) }}</textarea>
                </div>
                <button type="submit" id="submitButton" class="btn btn-warning">Update</button>
            </form>
        </div>
        <div class="col-2 d-none d-md-block">
        </div>
    </div>
@endsection

<style>
    #preview_image_container {
        height: 300px;
        width: 300px;
    }
    @media (max-width:435px) {
        #preview_image_container {
            height: 200px;
            width: 200px;
        }
    }
</style>

<script>
    function updatePreviewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview_image');
        console.log(input);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Set preview image source to the uploaded file
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const labelInput = document.getElementById('categoryLabelInput');


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
