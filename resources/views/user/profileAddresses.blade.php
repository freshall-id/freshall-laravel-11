@extends('layouts.dashboard')
@section('content')
    <div class="mt-5">
        <div class="mb-3">
            <i class="fa-solid fa-user " style="word-spacing: 40px"></i>
            <label class="fw-bold"for="">{{ $profile->username }}</label>
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{ route('profile.page') }}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('profileAddresses.page') }}">Address List</a>
            </li>
        </ul>

        <div class="mt-3 d-flex flex-column ">
            <div class="mt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add new Address</button>
            </div>

            @foreach ($addresses as $address)
                <div class="d-flex ">
                    <div class="card mt-4" style="width:50%">
                        <div class="card-header bg-warning">
                            {{ $address->label }}
                        </div>
                        <div class="card-body" style="background-color:#fff5d6">
                            <h5 class="card-title">{{ $address->receiver_name }}</h5>
                            <p class="card-text mb-1 fw-bold">{{ $address->category }}</p>
                            <p class="card-text mb-1">{{ $address->receiver_phone }}</p>
                            <p class="card-text mb-1">{{ $address->full_address }} ({{ $address->notes }})</p>
                            <div class="d-flex gap-4 justify-content-end mt-3" style="">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateModal">
                                    Update Address
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>




    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profileAddresses.update',$address->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mb-3 d-flex">
                                <label for="label" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Address Label</label>
                                <input type="text" id="label" name="label" class="form-control"
                                    value="{{ old('label', $address->label) }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="category" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Category</label>
                                <select class="form-select" name="category" aria-label="Default select example" style="width:200px">
                                    <option value="{{old('category',$address->category)}}">{{$address->category}}</option>
                                    <option value="KOST">KOST</option>
                                    <option value="OFFICE">OFFICE</option>
                                    <option value="APARTMENT">APARTMENT</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="full_address" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Full Address</label>
                                <input type="text" id="full_address" name="full_address" class="form-control"
                                    value="{{ old('full_address', $address->full_address) }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="receiver_name" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Receiver Name</label>
                                <input type="text" id="receiver_name" name="receiver_name" class="form-control"
                                    value="{{ old('receiver_name', $address->receiver_name) }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="receiver_phone" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Receiver Phone</label>
                                <input type="text" id="receiver_phone" name="receiver_phone" class="form-control"
                                    value="{{ old('receiver_phone', $address->receiver_phone) }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="postal_code" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control"
                                    value="{{ old('postal_code', $address->postal_code) }}" style="width:200px">
                            </div>
                            
                            <div class="mb-3 ">
                                <label for="notes" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Note</label>
                                <textarea id="notes" name="notes" class="form-control" rows="3"
                                    value="{{ old('notes', $address->notes) }}" style="width:340px">
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profileAddresses.insert',['address'=> $address]) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mb-3 d-flex">
                                <label for="label" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Address Label</label>
                                <input type="text" id="label" name="label" class="form-control"
                                    value="{{ old('label') }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="category" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Category</label>
                                <select class="form-select" name="category" aria-label="Default select example" style="width:200px">
                                    <option value="{{old('category')}}" disabled select>--select category--</option>
                                    <option value="HOME">HOME</option>
                                    <option value="KOST">KOST</option>
                                    <option value="OFFICE">OFFICE</option>
                                    <option value="APARTMENT">APARTMENT</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="full_address" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Full Address</label>
                                <input type="text" id="full_address" name="full_address" class="form-control"
                                    value="{{ old('full_address') }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="receiver_name" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Receiver Name</label>
                                <input type="text" id="receiver_name" name="receiver_name" class="form-control"
                                    value="{{ old('receiver_name') }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="receiver_phone" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Receiver Phone</label>
                                <input type="text" id="receiver_phone" name="receiver_phone" class="form-control"
                                    value="{{ old('receiver_phone') }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="latitude" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control"
                                    value="{{ old('latitude') }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="longitude" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control"
                                    value="{{ old('longitude') }}" style="width:200px">
                            </div>
                            <div class="mb-3 d-flex">
                                <label for="postal_code" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Postal Code</label>
                                <input type="text" id="postal_code" name="postal_code" class="form-control"
                                    value="{{ old('postal_code') }}" style="width:200px">
                            </div>
                            
                            <div class="mb-3 ">
                                <label for="notes" class="form-label mb-0 align-items-center d-flex"
                                    style="width:140px">Note</label>
                                <textarea id="notes" name="notes" class="form-control" rows="3"
                                    value="{{ old('notes') }}" style="width:340px">
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add New Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
