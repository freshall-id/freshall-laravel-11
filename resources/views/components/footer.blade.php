<footer class="px-3 px-sm-5 border-top p-0 pt-5 m-0 w-100 mt-5 container-fluid d-flex flex-column align-items-center">
    <div class="row w-100">
        <div class="col-lg-5 px-0 d-flex flex-column align-items-start justify-content-center">
            <img src="{{ asset('freshall/logo-with-text.svg') }}" alt="FRESHALL" width="200">
            <p class="text-muted mt-3 ms-lg-1">
                @lang('messages.footer-text')
            </p>
        </div>
        <div class="col-fluid col-sm px-0 mt-2 mt-sm-0 ms-lg-5">
            <h6 class="uppercase">@lang('messages.freshall')</h6>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('about.page') }}" class="hover-underline text-muted">@lang('messages.company-info')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.careers')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.blogs')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.investors')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.advertisers')</a>
                </li>
            </ul>
        </div>
        <div class="col-fluid col-sm px-0 mt-2 mt-sm-0 ms-sm-5">
            <h6 class="uppercase">@lang('messages.help-and-support')</h6>
            <ul class="list-unstyled">
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.information-center')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.refund-policy')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.delivery-information')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.payment-information')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.contact-center')</a>
                </li>
            </ul>
        </div>
        <div class="col-fluid col-sm px-0 mt-2 mt-sm-0 ms-sm-5">
            <h6 class="uppercase">@lang('messages.community')</h6>
            <ul class="list-unstyled">
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.community-guidelines')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.discussion')</a>
                </li>
                <li>
                    <a href="" class="hover-underline text-muted">@lang('messages.reviews')</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row border-top pt-3 d-flex flex-column-reverse flex-sm-row mt-5 p-0 m-0 w-100 pb-sm-0"">
        <h6 class="col-12 text-center text-sm-start mb-5 mb-sm-0 py-3 py-sm-0 mt-2 mt-sm-0 col-sm-3 mt-sm-0 p-0 m-0">
            © 2024 FRESHALL.ID
        </h6>
        <ul
            class="col-12 p-0 mt-3 mt-sm-0 col-sm-9 d-flex flex-column flex-sm-row list-unstyled gap-3 gap-sm-5 justify-content-sm-end">
            <li>
                <a href="{{ route('termsandconditions.page') }}" class="hover-underline text-muted">@lang('messages.terms')</a>
            </li>
            <li>
                <a href="{{ route('privacypolicy.page') }}" class="hover-underline text-muted">@lang('messages.privacy')</a>
            </li>
            <li>
                <a href="" class="hover-underline text-muted">@lang('messages.support')</a>
            </li>
        </ul>
    </div>

    <br />

</footer>
