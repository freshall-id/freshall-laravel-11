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
        @include("components.alert")
        
        <div class="text-warning text-center mt-3">
            <h2>
                <a href="{{ route('dashboard.page') }}">
                    <img width="200" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
                </a>
            </h2>
        </div>
        <main class="px-3 px-sm-5">
            @yield("content")
        </main>
        <div class="d-flex flex-row justify-content-center text-secondary ">
            <p class="text-muted ">© 2024, FRESHALL.ID |&nbsp; </p>
            <a class="text-decoration-none text-secondary" href="{{route('about.page')}}"> About |&nbsp;</a>
            <a class="text-decoration-none text-secondary" href="{{route('termsandconditions.page')}}"> Terms And Conditions |&nbsp;</a>
            <a class="text-decoration-none text-secondary" href="{{route('privacypolicy.page')}}"> Privacy Policy</a>
        </div>
    </body>
    <script src="{{ asset('index.js') }}"></script>
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.esm.min.js') }}"></script>
</html>