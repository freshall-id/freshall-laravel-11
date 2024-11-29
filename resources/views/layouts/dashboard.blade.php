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

<body>
    @include('components.alert')
    @if (!isset($hideNavbar) || !$hideNavbar)
        @include('components.navbar')
    @endif

    <main class="px-3 px-sm-5">
        @yield('content')
    </main>
    @if (!isset($hideFooter) || !$hideFooter)
        @include('components.footer')
    @endif
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('index.js') }}"></script>
</html>
