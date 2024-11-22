<div class="card w-100">
    <div class="card-header" style="background: var(--background)">
        {{ $voucher->discount * 10 }}% Off on All Items, up to Rp. {{ round($voucher->max_discount,0) }}
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>CODE: <b>{{ $voucher->code }}</b></p>
            <footer class="blockquote-footer">Until {{ $voucher->expired_at }}</footer>
        </blockquote>

        <div class="text-end mt-3">
            <a href="{{ route('use-voucher.page', ['voucher' => $voucher]) }}" class="btn btn-primary">
                Use Voucher
            </a>
        </div>
    </div>
</div>