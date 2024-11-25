<aside class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <section class="offcanvas-header justify-content-end px-5 mt-4">
        <button type="button" class="px-sm-1 btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </section>

    <section class="ms-5 mt-5">
        <ul class="list-unstyled d-flex flex-column gap-2">
            <li>
                <a href="" class="text-muted hover-underline">
                    @lang('messages.profile')
                </a>
            </li>
            <li>
                <a href="" class="text-muted hover-underline">
                    @lang('messages.my-orders')
                </a>
            </li>
            <li>
                <a href="" class="text-muted hover-underline">
                    @lang('messages.help-and-support')
                </a>
            </li>
            @auth
                <li>
                    <a href="{{ route('logout.page') }}" class="text-muted hover-underline">
                        @lang('messages.logout')
                    </a>
                </li>
            @endauth
        </ul>
    </section>

    <section class="m-5 mt-2 pt-3 border-top">
        <ul class="list-unstyled d-flex flex-column gap-2">
            <li>
                <a href="{{ route('dashboard.page') }}" class="hover-underline text-muted">
                    @lang('messages.home')
                </a>
            </li>
            <li>
                <a href="" class="hover-underline text-muted">
                    @lang('messages.news')
                </a>
            </li>
            <li>
                <a href="{{ route('register.page') }}" class="hover-underline text-muted">
                    @lang('messages.best-sellers')
                </a>
            </li>
            <li>
                <a href="{{ route('logout.page') }}" class="hover-underline text-muted">
                    
                    @lang('messages.vouchers')
                </a>
            </li>
        </ul>
    </section>

    <section class="dropdown m-5 ">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
              <a href="{{ route('set-locale.action', ['lang' => 'en']) }}" class="btn btn-primary">EN</a>
              <a href="{{ route('set-locale.action', ['lang' => 'idn']) }}" class="btn btn-primary">IDN</a>
            </div>
        </div>
    </section>

</aside>
