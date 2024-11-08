@if ($cart_items > 0)
    <a href="{{ route('cart.page') }}" class="position-relative">
        <div class="position-fixed px-2 text-light py-3 m-2 rounded row border border-light" style="background-color: var(--accent-yellow); right: 0.5rem; bottom: 0.5rem; z-index: 100;">
            <img src="{{ asset('icon/ui/cart-white.svg') }}" alt="cart_icon" style="width: 3.5rem;">
            <span class="h6 position-absolute bg-danger p-0" style="width: 0.8rem; aspect-ratio: 1/1; border-radius: 100%; right: 1rem; top: 1rem;">
            </span>
        </div>
    </a>
@endif
