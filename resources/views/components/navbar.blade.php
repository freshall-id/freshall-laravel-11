{{-- desktop view navbar --}}
<section class="d-flex flex-row mt-3 mb-3 justify-content-center d-sm-none align-items-center">
    <a href="{{ route('dashboard.page') }}">
        <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
    </a>
</section>

<section class="px-3 px-sm-5 bg-light overflow-auto border">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link text-muted hover-underline pe-0 text-end" href="#">@lang('messages.promotions')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted hover-underline pe-0 text-end" href="#">@lang('messages.freshall-care')</a>
        </li>
    </ul>
</section>

<nav class="px-4 px-sm-5 container-fluid">
    <section class="navbar row navbar-light justify-content-end justify-content-sm-between py-2">
        <a href="{{ route('dashboard.page') }}" class="col-sm-3 d-none d-sm-block">
            <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
        </a>

        <section
            class="col-12 col-sm-5 px-1 px-sm-0 d-flex flex-row gap-3 align-items-center m-0 p-0 justify-content-start justify-content-sm-center bg-white">
            <form action="{{ route('search.page') }}" method="GET"
                class=" d-sm-flex input-group text-decoration-none">
                <span class="input-group-text">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input name="query" type="search" id="search-input" placeholder="@lang('messages.search')"
                    class="form-control">
            </form>

            <div class="d-flex flex-row gap-sm-2 ms-sm-2">
                <a href="{{ route('cart.page') }}" class="text-reset p-2 pt-3 h5">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                <div class="position-relative" onmouseout="shrinkDropdown(this)" onmouseover="expandDropdown(this)">
                    <a class="d-none d-sm-block text-reset h5 pt-3 p-2 me-2" type="button" aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <ul class="position-absolute z-max d-none bg-white px-3 py-4 border list-unstyled p-0 m-0 end-0"
                        onmouseover="expandDropdown(this)" onmouseout="shrinkDropdown(this.parentElement)"
                        style="width: 14rem;">
                        @guest
                            <li class="text-reset mb-4">
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary w-100 text-decoration-none text-white">@lang('messages.login-or-register')</a>
                            </li>
                        @endguest
                        <li><a class="dropdown-item" href="#">@lang('messages.profile')</a></li>
                        <li><a class="dropdown-item" href="#">@lang('messages.my-orders')</a></li>
                        <li><a class="dropdown-item" href="#">@lang('messages.help-and-support')</a></li>

                        @auth
                            <li><a class="dropdown-item" href="{{ route('logout.page') }}">@lang('messages.logout')</a></li>
                        @endauth
                    </ul>
                </div>
                <a data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar"
                    class="p-2 pt-3 h5 d-sm-none text-decoration-none text-reset">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
        </section>
    </section>

    <section class="navbar d-none d-sm-flex border-bottom">
        <ul class="navbar-nav d-none d-sm-flex flex-row justify-content-center align-items-center gap-3">
            <li class="nav-item">
                <a href="{{ route('dashboard.page') }}" class="uppercase hover-underline text-muted">
                    @lang('messages.home')
                </a>
            </li>
            <li class="nav-item">
                <a class="uppercase hover-underline text-muted">
                    @lang('messages.news')
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('register.page') }}" class="uppercase hover-underline text-muted">
                    @lang('messages.best-sellers')
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout.page') }}" class="uppercase hover-underline text-muted">
                    @lang('messages.vouchers')
                </a>
            </li>
        </ul>
        <a data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar"
            class="uppercase d-none pr-2 hover-underline text-muted d-sm-flex align-items-center justify-content-center flex-row gap-2">
            @lang('messages.menu')
        </a>
    </section>
</nav>

@include('components.navbar-sidebar')

{{-- mobile view navbar --}}
<nav
    class="position-fixed bg-white d-sm-none w-100 d-flex bottom-0 m-0 p-0 overflow-hidden p-3 px-2 pt-4 shadow-inner z-max">
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
