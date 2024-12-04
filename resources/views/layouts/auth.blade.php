<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>FRESHALL | Fresh Groceries, Delivered with Care</title>

    <style>
        :root {
            --background: #FEF7DD;
            --accent-yellow: #F8C10B;
            --accent-blue: #0B42F8;
            --accent-red: #F84A0B;
            --accent-black: #1A1A1A;
            --accent-slate: #f1f5f9;
        }

        .hover-underline {
            text-decoration: none;
        }

        .hover-underline:hover {
            text-decoration: underline;
        }

        /* override bootstrap main classes */
        .page-item.active .page-link {
            background-color: var(--accent-yellow) !important;
            border-color: var(--accent-yellow) !important;
        }

        .page-link {
            color: var(--accent-black) !important;
        }

        .btn-primary, .btn-primary:active, .btn-primary:visited {
            background-color: var(--accent-yellow) !important;
            border-color: var(--accent-yellow) !important;
        }

        .btn-primary:hover {
            background-color: var(--accent-yellow) !important;
            border-color: var(--accent-yellow) !important;
        }

        @media (max-width: 576px) {
            .offcanvas {
                width: 100%;
            }
        }

        /* borrow some classes from tailwindcss */
        .bg-opacity-20 {
            background-color: rgba(0, 0, 0, 0.2);
        }

        /* custom classes */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-none {
            -ms-overflow-style: none;  
            scrollbar-width: none;  
        }

        .filter:active {
            background-color: var(--accent-yellow) !important;
        }

        .filter {
            background-color: var(--background) !important;
        }

        .card-registration {
            width: 50%;
        }

        .w-75-md-25 {
            width: 25%;
        }

        @media (max-width: 576px) {
            .card-registration {
                width: 100%;
            }
            
            .w-75-md-25 {
                width: 75%;
            }
        }

        @media (max-width: 768px) {
            .card-registration {
                width: 70%;
            }
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
    <link rel="icon" href="{{ asset('freshall/logo-light-mode.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
