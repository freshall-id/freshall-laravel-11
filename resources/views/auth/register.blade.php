@extends('app')

@section('content')
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col" style="padding: 0 17%">
                    <div class="card card-registration my-4 shadow-sm">
                        <div class="row g-0" >
                            <div>
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase text-center">Register</h3>
                                    <form action="{{ route('register.action') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="username">Username</label>
                                                    <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input type="text" id="name" name="name" class="form-control form-control-lg" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 class="mb-0 me-4 fw-normal">Gender: </h6>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <label class="form-check-label" for="femaleGender">Female</label>
                                                <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                                value="FEMALE" />
                                            </div>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <label class="form-check-label" for="maleGender">Male</label>
                                                <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                                value="MALE" />
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                        </div>



                                        <div class="d-flex justify-content-center pt-3">
                                            <button  type="submit" class="btn btn-warning btn-lg w-100">Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp