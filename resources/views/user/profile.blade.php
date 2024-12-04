@extends('layouts.dashboard')
@section('content')
    <div class="mt-5">
        <div class="mb-3">
            <i class="fa-solid fa-user " style="word-spacing: 40px"></i>
            <label class="fw-bold"for="">{{ $profile->username }}</label>
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('profile.page') }}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{ route('profileAddresses.page') }}">Address List</a>
            </li>
        </ul>

        <form class="mt-4 d-flex flex-column" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @php
                $profileImagePath = 'public/profile/' . $profile->profile_image;
                $imageUrl = Storage::exists($profileImagePath)
                    ? asset('storage/' . $profileImagePath)
                    : asset('default/user.png');
            @endphp
            <div class="d-flex gap-5 " id="profileContainer">
                <div class="card" style="width: 18rem;">
                    <img id="preview_image" src="{{ $imageUrl }}" class="card-img-top" style="height:300px"
                        alt="Profile Picture">
                    <div class="card-body">
                        <input type="file" class="d-none" name="profile_image" id="profile_image" value="Choose Photo"
                            onchange="previewFile()">
                        <button type="button" class="btn btn-outline-warning w-100 text-muted" name="profile_image"
                            style="max-width: 100%" onclick="document.getElementById('profile_image').click();">
                            <label class="fw-bold" for="">Choose Photo</label>
                        </button>
                    </div>
                </div>
                <div id="changeProfileContainer">
                    <label class="fw-bold text-secondary"for="">Change Profile</label>
                    <div class="mb-3 d-flex">
                        <label for="username" class="form-label mb-0 align-items-center d-flex"
                            style="width:140px">Username</label>
                        <input type="text" id="username" name="username" class="form-control"
                            value="{{ old('username', $profile->username) }}" style="width:200px">
                    </div>
                    <div class="mb-3 d-flex">
                        <label for="name" class="form-label mb-0 align-items-center d-flex" style="width:140px">Full
                            Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', $profile->name) }}" style="width:200px">
                    </div>
                    <div class="mb-3 d-flex">
                        <label for="date_of_birth" class="form-label mb-0 align-items-center d-flex"
                            style="width:140px">Date Of
                            Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                            value="{{ old('date_of_birth', $profile->date_of_birth) }}" style="width:200px">
                    </div>
                    <div class="mb-3 d-flex">

                        <h6 class=" fw-normal" style="width:140px">Gender: </h6>

                        <div class="form-check form-check-inline mb-0 me-4">
                            <label class="form-check-label" for="femaleGender">Female</label>
                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="FEMALE"
                                {{ old('gender', $profile->gender) == 'FEMALE' ? 'checked' : '' }} />
                        </div>

                        <div class="form-check form-check-inline mb-0 me-4">
                            <label class="form-check-label" for="maleGender">Male</label>
                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="MALE"
                                {{ old('gender', $profile->gender) == 'MALE' ? 'checked' : '' }} />
                        </div>
                    </div>

                    <label class="fw-bold text-secondary mt-2"for="">Change Contact</label>
                    <div class="mb-3 d-flex">
                        <label for="email" class="form-label mb-0 align-items-center d-flex"
                            style="width:140px">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', $profile->email) }}" style="width:200px">
                    </div>
                    <div class="mb-3 d-flex">
                        <label for="phone_number" class="form-label mb-0 align-items-center d-flex"
                            style="width:140px">Phone Number</label>
                        <input type="phone_number" id="phone_number" name="phone_number" class="form-control"
                            value="{{ old('phone_number]', $profile->phone_number) }}" style="width:200px">
                    </div>

                </div>
                <div id="changePasswordContainer">
                    <label class="fw-bold text-secondary "for="">Change Password</label>
                    <div class="mb-3 d-flex">
                        <label for="Current_password" class="form-label mb-0 align-items-center d-flex"
                            style="width:160px">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="form-control"
                            style="width:200px">
                    </div>

                    <div class="mb-3 d-flex">
                        <label for="new_password" class="form-label mb-0 align-items-center d-flex"
                            style="width:160px">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control"
                            style="width:200px">
                    </div>

                    <div class="mb-3 d-flex">
                        <label for="new_confirmation_password" class="form-label mb-0 align-items-center d-flex"
                            style="width:160px">Confirm Password</label>
                        <input type="password" id="new_confirmation_password" name="new_confirmation_password"
                            class="form-control" style="width:200px">
                    </div>

                </div>
            </div>
            <div id="updateButton">
                <button type="submit" class="btn btn-primary mt-3"  style="width:18em">Update</button>
            </div>

        </form>
    </div>
@endsection

<style>
    @media(max-width:1135px){
        #profileContainer{
            flex-direction: column;
            justify-content: center;
            align-items:center;
        } 
        #updateButton{
            display:flex;
            justify-content: center;
            align-items:center;
        }
    }
</style>

<script>
    function previewFile() {
        const file = document.getElementById('profile_image').files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            document.getElementById('preview_image').src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
