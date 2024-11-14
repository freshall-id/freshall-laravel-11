@extends('auth.layout')

@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="w-100" style="padding: 0 25%">
                    <div class="col w-100 card card-registration my-4 shadow-sm">
                        <div class="row g-0 justify-content-center">
                            <div class="card-body p-md-5 pt-3 text-black">
                                <h3 class="mb-5 text-uppercase text-center">Login</h3>

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
                                <div class="d-flex flex-row justify-content-center gap-2 mt-2">
                                    <p>Don't have an account?</p>
                                    <a href="{{ route('register.page') }}" class="text-decoration-none text-primary">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection