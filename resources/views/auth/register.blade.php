@extends('layouts.auth')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="w-100" style="padding: 0 25%">
                    <div class="col w-100 card card-registration my-4 shadow-sm">
                        <div class="row g-0 justify-content-center">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-5 text-uppercase text-center">Register</h3>
                                <form action="{{ route('register.action') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" id="username" name="username"
                                                    class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="name">Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="form-control form-control-lg" />
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
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" />
                                    </div>

                                    <div class="form-check mb-4 d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input" id="btncheck1"
                                            name="terms and conditions" value="yes">
                                        <label class="ms-2">
                                            <label class="form-check-label">By registering, I agree to the
                                                <a href="#"
                                                    class="text-primary text-decoration-none"data-bs-toggle="modal"
                                                    data-bs-target="#termsandconditionsmodal">
                                                    Terms and Conditions
                                                </a>
                                                <label>and</label>
                                                <a href="#"
                                                    class="text-primary text-decoration-none"data-bs-toggle="modal"
                                                    data-bs-target="#privacypolicymodal">
                                                    Privacy Policy
                                                </a>
                                            </label>
                                        </label>
                                    </div>

                                    <div class="modal fade" id="termsandconditionsmodal" tabindex="-1"
                                        aria-labelledby="termsandconditionsLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="termsandconditionsLabel">Terms and
                                                        Conditions
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('components.t&c-content')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="privacypolicymodal" tabindex="-1"
                                        aria-labelledby="privacypolicyLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="privacypolicyLabel">Privacy Policy
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @include('components.privacypolicy-content')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center pt-3">
                                        <button type="submit" class="btn btn-warning btn-lg w-100">Register</button>
                                    </div>
                                </form>
                                <div class="d-flex flex-column flex-md-row justify-content-center gap-0 gap-md-2 mt-2">
                                    <p>Already have an account?</p>
                                    <a href="{{ route('login') }}" class="text-decoration-none text-primary">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
