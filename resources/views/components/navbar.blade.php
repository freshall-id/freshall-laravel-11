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

<nav class="px-4 px-sm-5 container-fluid">
    <section class="navbar row navbar-light justify-content-end justify-content-sm-between py-2">
        <a href="{{ route('dashboard.page') }}" class="col-sm-3 d-none d-sm-block">
            <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
        </a>

        <section class="col-12 col-sm-5 px-1 px-sm-0 d-flex flex-row gap-3 align-items-center m-0 p-0 justify-content-start justify-content-sm-center bg-white">
            <a href="{{ route('search.page', ['query' => ""]) }}" class=" d-sm-flex input-group text-decoration-none">
                <span class="input-group-text">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="search" id="search-input" placeholder="Search" class="form-control">
            </a>

            <a href="{{ route('cart.page') }}" class="text-reset p-2 pt-3 h5">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <div class="position-relative" onmouseout="shrinkDropdown(this)" onmouseover="expandDropdown(this)">
                <a class="d-none d-sm-block text-reset h5 pt-3 p-2 me-2" type="button" aria-expanded="false">
                    <i class="fa-regular fa-user"></i>
                </a>
                <ul class="position-absolute z-max d-none bg-white px-3 py-4 border list-unstyled p-0 m-0 end-0" onmouseover="expandDropdown(this)" onmouseout="shrinkDropdown(this.parentElement)">
                    @if (!Auth::check())
                        <li class="text-reset mb-4">
                            <a href="{{ route('login.page') }}" class="btn btn-primary w-100 text-decoration-none text-white">Login or Register</a>
                        </li>
                    @endif
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Orders</a></li>
                    <li><a class="dropdown-item" href="#">Help and Support</a></li>

                    @if (Auth::check())
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    @endif
                </ul>
            </div>
            <a data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar" class="p-2 pt-3 h5 d-sm-none text-decoration-none text-reset">
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
            <li class="nav-item">
                <a class="hover-underline text-muted">
                    NEWS
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('register.page') }}" class="hover-underline text-muted">
                    BEST SELLERS
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout.page') }}" class="hover-underline text-muted">
                    VOUCHERS
                </a>
            </li>
        </ul>
        <a data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar" class="d-none pr-2 hover-underline text-muted d-sm-flex align-items-center justify-content-center flex-row gap-2">
            MENU
        </a>
    </section>
</nav>

<x-navbar-sidebar />

{{-- mobile view navbar --}}
<nav class="position-fixed bg-white d-sm-none w-100 d-flex bottom-0 m-0 p-0 overflow-hidden p-3 px-2 pt-4 shadow-inner z-max">
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

{{-- script for dropdown --}}
<script>
    function expandDropdown(e) {
        const dropdownMenu = e.children[1] || e;
        dropdownMenu.classList.remove("d-none");
    }

    function shrinkDropdown(e) {
        const dropdownMenu = e.children[1];
        dropdownMenu.classList.add("d-none");
    }
</script>