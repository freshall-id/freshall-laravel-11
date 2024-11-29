<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>FRESHALL | Fresh Groceries, Delivered with Care</title>

    <link rel="icon" href="{{ asset('freshall/logo-light-mode.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('index.js') }}"></script>
</html>
