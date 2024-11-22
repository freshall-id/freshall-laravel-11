<?php

namespace App\View\Components;

use App\Models\Voucher;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VoucherCard extends Component
{
    public function __construct(public Voucher $voucher) {}

    public function render(): View|Closure|string
    {
        return view('components.voucher-card');
    }
}
