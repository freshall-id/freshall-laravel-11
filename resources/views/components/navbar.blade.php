{{-- desktop view navbar --}}
<section class="d-flex flex-row mt-3 mb-3 justify-content-center d-sm-none align-items-center">
    <a href="{{ route('dashboard.page') }}">
        <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
    </a>
</section>

<section class="px-3 px-sm-5 bg-light overflow-auto border">
    <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link text-muted hover-underline pe-0 text-end" href="#">Promotions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-muted hover-underline pe-0 text-end" href="#">Freshall Care</a>
        </li>
      </ul>
</section>

<nav class="px-3 px-sm-5 container-fluid">
    <section class="navbar row navbar-light justify-content-end justify-content-sm-between py-2">
        <a href="{{ route('dashboard.page') }}" class="col-sm-3 d-none d-sm-block">
            <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
        </a>

        <section class="col-12 col-sm-5 px-2 px-sm-0 d-flex flex-row gap-3 align-items-center m-0 p-0 justify-content-start justify-content-sm-center bg-white">
            <a href="{{ route('search.page', ['query' => ""]) }}" class=" d-sm-flex input-group text-decoration-none">
                <span class="input-group-text">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="search" id="search-input" placeholder="Search" class="form-control">
            </a>

            <a href="{{ route('cart.page') }}" class="text-reset p-2 pt-3 h5">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <a href="" class="d-none d-sm-block text-reset h5 pt-3 p-2 me-2">
                <i class="fa-regular fa-user"></i>
            </a>
            <a data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar" class="p-2 pt-3 h5 d-sm-none text-decoration-none text-reset d-flex align-items-center justify-content-center flex-row gap-2">
                <i class="fa-solid fa-bars"></i>
            </a>
        </section>
    </section>

    <section class="navbar d-none d-sm-flex border-bottom">
        <ul class="navbar-nav d-none d-sm-flex flex-row justify-content-center align-items-center gap-3">
            <li class="nav-item">
                <a href="{{ route('dashboard.page') }}" class="hover-underline text-muted">
                    HOME
                </a>
            </li>
            @if (!Auth::check())
                <li class="nav-item">
                    <a href="{{ route('login.page') }}" class="hover-underline text-muted">
                        SIGN IN
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('register.page') }}" class="hover-underline text-muted">
                        SIGN UP
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('logout.page') }}" class="hover-underline text-muted">
                        LOGOUT
                    </a>
                </li>
            @endif
        </ul>
        <a data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar" class="d-none pr-2 hover-underline text-muted d-sm-flex align-items-center justify-content-center flex-row gap-2">
            MENU
        </a>
    </section>
</nav>

<x-navbar-sidebar />

{{-- mobile view navbar --}}
<nav class="position-fixed bg-white d-sm-none w-100 d-flex bottom-0 m-0 p-0 overflow-hidden p-3 px-3 pt-4" style="box-shadow: inset 0 2px 4px 0 rgb(0 0 0 / 0.05); z-index: 1000;">
    <ul class="d-flex flex-row w-100 m-0 p-0 justify-content-between">
        <li class="list-unstyled m-0 p-0">
            <a href="" class="text-reset p-3">
                <i class="fa-solid fa-home h5"></i>
            </a>
        </li>
        <li class="list-unstyled m-0 p-0">
            <a href="" class="text-reset p-3">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </li>
        <li class="list-unstyled m-0 p-0">
            <a href="" class="text-reset p-3">
                <i class="fa-solid fa-receipt"></i>
            </a>
        </li>
        <li class="list-unstyled m-0 p-0">
            <a href="" class="text-reset p-3">
                <i class="fa-regular fa-user"></i>
            </a>
        </li>
    </ul>
</nav>