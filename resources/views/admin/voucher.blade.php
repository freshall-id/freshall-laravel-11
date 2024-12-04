@extends('layouts.admin')

@section('content')
    <div class="my-5">
        <h2 class="fw-bold">Manage Voucher</h2>
    </div>
    <a href="{{ route('create.voucher.page') }}" class="mb-3 btn btn-primary">Create New Voucher</a>
    <x-voucher-table :vouchers="$vouchers" />
@endsection
