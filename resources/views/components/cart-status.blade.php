@if ($cart_items > 0)
    <a href="{{ route('cart.page') }}" class="position-relative">
        <div class="position-fixed d-none d-sm-block text-light m-2 rounded row z-max p-2 shadow" style="background-color: var(--accent-yellow); right: 0.5rem; bottom: 0.5rem;">
            <i class="fa-solid fa-bag-shopping d-flex align-items-center justify-content-center p-0 m-0" style="font-size: 2rem; width: 3rem; height: 3rem;"></i>
            <span class="position-absolute bg-danger p-0" style="width: 0.8rem; aspect-ratio: 1/1; border-radius: 100%; right: 0.6rem; top: 1rem;">
            </span>
        </div>
    </a>
@endif
