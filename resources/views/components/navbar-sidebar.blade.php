<aside class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <section class="offcanvas-header justify-content-end px-5 mt-4">
        <button type="button" class="px-sm-1 btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </section>
    <section class="offcanvas-body px-5">
        
        <div class="accordion accordion-flush mt-3" id="accordion">
            @if ($product_categories->count() > 0)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Product Categories
                        </button>
                    </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                @foreach ($product_categories as $product_category)
                                    <li>
                                        <a href="" class="hover-underline text-muted">
                                            {{ $product_category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

</aside>