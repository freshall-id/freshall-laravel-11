<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>FRESHALL | Fresh Groceries, Delivered with Care</title>

    <link rel="icon" href="{{ asset('freshall/logo-light-mode.svg') }}" type="image/x-icon">
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

        .w-md-50 {
            width: 100%;
        }

        .resize-none {
            resize: none;
        }

        @media (max-width: 576px) {
            .offcanvas {
                width: 100%;
            }
        }

        /* borrow some classes from tailwindcss */
        .shadow-inner {
            box-shadow: inset 0 2px 4px 0 rgb(0 0 0 / 0.05);
        }

        .bg-opacity-20 {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .bg-transparent {
            background-color: transparent !important;
        }

        .w-5 {
            width: 1.25rem;
        }

        /* custom classes */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-none {
            -ms-overflow-style: none;  
            scrollbar-width: none;  
        }

        .z-max {
            z-index: 1000;
        }

        .filter:active {
            background-color: var(--accent-yellow) !important;
        }

        .filter {
            background-color: var(--background) !important;
        }

        .quantity-selector {
            border: 1px solid var(--accent-slate);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100px;
            background-color: var(--accent-slate);
        }

        .quantity-selector button {
            border: none;
            background-color: transparent;
            font-size: 1.2rem;
            color: #555; 
            width: 30px;
            height: 30px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .quantity-selector input {
            border: none;
            text-align: center;
            width: 40px;
            background-color: transparent;
            font-size: 1rem;
        }

        .quantity-selector button:focus, .quantity-selector input:focus {
            outline: none;
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
