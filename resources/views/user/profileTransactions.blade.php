@extends('layouts.dashboard')

@section('content')
    <div class="mt-5">
        <div class="mb-3">
            <i class="fa-solid fa-user " style="word-spacing: 40px"></i>
            <label class="fw-bold"for="">{{ $profile->username }}</label>
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{ route('profile.page') }}">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{ route('profileAddresses.page') }}">Address List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                    href="{{ route('profileTransactions.page') }}">Transactions</a>
            </li>
        </ul>

        <div class="row justify-content-center d-flex">
            @foreach ($transactions as $transaction)
                <div class="col-10 border mt-4" style="padding: 0%">
                    <div
                        class="container-fluid text-center bg-warning d-flex justify-content-between align-items-center p-2 ps-3 pe-3">
                        <h3 style="margin:0%;padding:0%">
                            {{ $transaction->invoice_number }}
                        </h3>
                        <h5 style="margin:0%;padding:0%">
                            {{ $transaction->created_at }}
                        </h5>
                    </div>

                    <div class="p-3">
                        <div>
                            <h3
                                class="
                                @if ($transaction->status === 'COMPLETED') text-success 
                                @elseif (in_array($transaction->status, ['PENDING', 'INPROCESS', 'ONHOLD'])) text-warning 
                                @elseif (in_array($transaction->status, ['CANCELED', 'FAILED', 'TROUBLE'])) text-danger @endif
                                ">
                                {{ $transaction->status }}
                            </h3>
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="pe-2">
                                    Total
                                </h4>
                                <h4 style="font-weight:normal;">
                                    {{ $transaction->priceToNumberFormat($transaction->price_total) }}
                                </h4>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="pe-2">
                                    Shipping Status
                                </h4>
                                <h4 class="
                                    @if ($transaction->shipping_status === 'DELIVERED') text-success 
                                    @elseif (in_array($transaction->shipping_status, ['WAITING', 'SHIPPED', 'INPROCESS'])) text-warning 
                                    @elseif (in_array($transaction->shipping_status, ['LOST', 'DAMAGED', 'RETURNED'])) text-danger @endif
                                    "
                                    style="font-weight: normal">
                                    {{ $transaction->shipping_status }}
                                </h4>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <h4 class="pe-2">
                                    Payment Status
                                </h4>
                                <h4 class="
                                        @if ($transaction->payment_status === 'PAID') text-success 
                                        @elseif (in_array($transaction->payment_status, ['PENDING', 'WAITING'])) text-warning 
                                        @elseif (in_array($transaction->payment_status, ['FAILED', 'REFUNDED', 'CANCELED'])) text-danger @endif"
                                    style="font-weight: normal;">
                                    {{ $transaction->payment_status }}
                                </h4>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('profileTransactionDetail.page', ['id' => $transaction->id]) }}" type="button"
                                class="btn btn-warning text-light">
                                <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
@endsection
