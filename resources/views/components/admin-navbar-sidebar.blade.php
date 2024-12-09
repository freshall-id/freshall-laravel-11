<nav class="navbar navbar-light bg-light sticky-top bg-light" style="z-index: 50">
    <div class="container-fluid">
        <div class="d-flex flex-row gap-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{ route('admin-dashboard.page') }}" class="col-sm-3 d-none d-sm-block">
                <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
            </a>
        </div>
        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel" style="background-color: white !important;">
            <div class="offcanvas-header">
                <a href="{{ route('admin-dashboard.page') }}" class="col-sm-3 d-none d-sm-block">
                    <img width="120" src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL">
                </a>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('admin-dashboard.page') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Manage
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light">
                            <li><a class="dropdown-item" href="{{ route('admin-user.page') }}">User</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin-product.page') }}">Product</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin-productCategory.page') }}">Category</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin-voucher.page') }}">Voucher</a></li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
            <div class="accordion accordion-flush" id="accordionManage">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingManage">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseManage" aria-expanded="false" aria-controls="collapseManage">
                    Manage
                  </button>
                </h2>
                <div id="collapseManage" class="accordion-collapse collapse" aria-labelledby="headingManage" data-bs-parent="#accordionManage">
                  <div class="accordion-body">
                    <ul class="list-unstyled">
                      <li>
                        <a href="#" class="text-muted">User</a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li>
                        <a href="#" class="text-muted">Product</a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li>
                        <a href="#" class="text-muted">Category</a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li>
                        <a href="#" class="text-muted">Voucher</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('logout.page') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
