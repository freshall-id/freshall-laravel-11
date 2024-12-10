@extends('layouts.admin')

@section('content')
    <div class="row d-flex justify-content-center g-2 g-md-5 pt-4">
        <div class="col-1 col-md-2 d-flex justify-content-end">
            <div>
                <a href="{{ url()->previous() }}" class="btn mt-2" style="height: 30px">
                    <i class="fa-solid fa-arrow-left fa-2xl mt-2"></i>
                </a>
            </div>
        </div>
        <div class="col-9 col-md-8 border border-3 rounded shadow py-3 px-3">
            <h1 class="pb-2">Create Product Category</h1>
            <form action="{{ route('create.productCategory.action') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="labelInput" class="form-label">Choose a category label</label>
                    <select class="form-select" id="labelInput" name="label">
                        @foreach (['OTHER', 'VEGETABLE', 'MEAT', 'FRUIT'] as $categoryLabel)
                            <option value="{{ $categoryLabel }}" @selected(old('label') == $categoryLabel)>{{ $categoryLabel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nameInput" placeholder="Contoh : Buah Lokal" name = "name"
                        value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name = "image" value="{{ old('image') }}">
                </div>
                <div class="mb-3">
                    <label for="descriptionInput" class="form-label">Description</label>
                    <textarea class="form-control" id="descriptionInput" rows="3" name ="description"
                        placeholder="Contoh : Full natural">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Submit</button>
            </form>
        </div>
        <div class="col-2 d-none d-md-block">
        </div>
    </div>
@endsection
