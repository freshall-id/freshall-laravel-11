@extends('app')

@section('content')
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col px-2 d-flex justify-content-center">
                    <div class="card card-registration my-4 shadow-sm">
                        <div class="row g-0 justify-content-center">
                            <div class="py-3">
                                <div class="card-body p-md-5 text-black">
                                    <h3 class="mb-5 text-uppercase text-center fw-bold">Login</h3>

                                    <form action="{{ route('login.action') }}" method="POST">
                                        @csrf

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <div class="form-check">
                                                <label class="form-check-label" for="remember"> Remember me </label>
                                                <input class="form-check-input" type="checkbox" value="true" id="remember" name="remember" />
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-start pt-3">
                                            <button  type="submit" class="btn btn-warning btn-lg w-100">Login</button>
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