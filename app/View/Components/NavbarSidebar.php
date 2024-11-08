<?php

namespace App\View\Components;

use App\Models\ProductCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavbarSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product_categories = ProductCategory::orderBy('name', 'asc')->get();

        return view('components.navbar-sidebar', [
            'product_categories' => $product_categories,
        ]);
    }
}
