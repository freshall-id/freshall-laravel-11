<aside class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <section class="offcanvas-header justify-content-end px-5 mt-4">
        <button type="button" class="px-sm-1 btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </section>

    <section class="ms-5 mt-5">
        <ul class="list-unstyled d-flex flex-column gap-2">
            <li>
                <a href="{{ route('profile.page') }}" class="text-muted hover-underline">
                    Profile
                </a>
            </li>
            <li>
                <a href="{{ route('profileTransactions.page') }}" class="text-muted hover-underline">
                    Orders
                </a>
            </li>
            <li>
                <a href="" class="text-muted hover-underline">
                    Help & Support
                </a>
            </li>
            @auth
                <li>
                    <a href="{{ route('logout.page') }}" class="text-muted hover-underline">
                        Logout
                    </a>
                </li>
            @endauth
        </ul>
    </section>

    <section class="m-5 mt-2 pt-3 border-top">
        <ul class="list-unstyled d-flex flex-column gap-2">
            <li>
                <a href="{{ route('dashboard.page') }}" class="hover-underline text-muted">
                    Home
                </a>
            </li>
            <li>
                <a href="" class="hover-underline text-muted">
                    News
                </a>
            </li>
            <li>
                <a href="{{ route('register.page') }}" class="hover-underline text-muted">
                    Best Sellers
                </a>
            </li>
            <li>
                <a href="{{ route('logout.page') }}" class="hover-underline text-muted">
                    Vouchers
                </a>
            </li>
        </ul>
    </section>

</aside>
