@extends("layouts.dashboard")

@section("content")
    <section class="mt-5">
        <div class="mb-3">
            <h5 class="text-muted">
                <small>
                    Your discount has been applied to your order. Enjoy your savings!
                </small>
            </h5>
            <h2>Voucher Successfully Applied</h2>
        </div>

        <x-voucher-card :voucher="$voucher" />
    </section>
@endsection
