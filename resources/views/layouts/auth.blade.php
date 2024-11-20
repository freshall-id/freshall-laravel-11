<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FRESHALL | Fresh Groceries, Delivered with Care</title>

    <link rel="icon" href="{{ asset('freshall/logo-light-mode.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-utilities.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="antialiased">
    @include('components.alert')

    <div class="text-warning text-center mt-4 mb-4">
        <h2>
            <a href="{{ route('dashboard.page') }}">
                <img width="200" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
            </a>
        </h2>
    </div>

    <main class="px-3 px-sm-5">
        @yield('content')
    </main>
    <div class="d-flex mb-3 mt-5 flex-column w-100 justify-content-center align-items-center text-secondary ">
        <p class="text-muted">© 2024, FRESHALL.ID </p>

        <div class="gap-4 d-flex flex-row justify-content-between">
            <a class="text-muted hover-underline" href="{{ route('termsandconditions.page') }}">Terms</a>
            <a class="text-muted hover-underline" href="{{ route('privacypolicy.page') }}">Privacy Policy</a>
            <a class="text-muted hover-underline" href="{{ route('about.page') }}">About</a>
        </div>
    </div>
</body>
<script src="{{ asset('index.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.esm.min.js') }}"></script>

</html>
