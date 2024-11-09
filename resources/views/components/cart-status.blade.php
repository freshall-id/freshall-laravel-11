@if ($cart_items > 0)
    <a href="{{ route('cart.page') }}" class="position-relative">
        <div class="position-fixed d-none d-sm-flex align-items-center justify-content-center px-2 text-light py-2 pt-3 m-2 rounded row border border-light z-max" style="background-color: var(--accent-yellow); right: 0.5rem; bottom: 0.5rem;">
            <i class="fa-solid fa-cart-shopping h3"></i>
            <span class="h6 position-absolute bg-danger p-0" style="width: 0.8rem; aspect-ratio: 1/1; border-radius: 100%; right: 0.8rem; top: 0.8rem;">
            </span>
        </div>
    </a>
@endif
