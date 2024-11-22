@extends('layouts.admin')

@section('content')
    <div>
        <div class="pt-3"> <h4 class="text-muted">Dashboard</h4> </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 mt-3 mb-5">
            <div class="col">
                <div class="ps-1 bg-primary rounded shadow h-100 d-flex align-items-center justify-content-center">
                    <div class="bg-white rounded px-3 py-4 w-100 h-100">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            <div class="me-1">
                                <p class="m-0 mb-1 text-primary fw-bold" style="font-size: 14px;">EARNINGS (MONTHLY)</p>
                                <h4 class="text-muted fs-6 m-0">{{$earningsMonthly}}</h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar fa-xl" style="color: gray;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="ps-1 bg-danger rounded shadow h-100 d-flex align-items-center justify-content-center">
                    <div class="bg-white rounded px-3 py-4 w-100 h-100">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            <div class="me-1">
                                <p class="m-0 mb-1 text-danger fw-bold" style="font-size: 14px;">TRANSACTIONS (TROUBLE)</p>
                                <h4 class="text-muted fs-6 m-0">{{$transactionsTrouble}}</h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-circle-exclamation fa-xl" style="color: gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="ps-1 bg-warning rounded shadow h-100 d-flex align-items-center justify-content-center">
                    <div class="bg-white rounded px-3 py-4 w-100 h-100">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            <div class="me-1">
                                <p class="m-0 mb-1 fw-bold" style="font-size: 14px; color: hsl(51, 100%, 46%);">TRANSACTIONS (INPROCESS)</p>
                                <h4 class="text-muted fs-6 m-0">{{$transactionsInProcess}}</h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-arrows-rotate fa-xl" style="color: gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="ps-1 bg-success rounded shadow h-100 d-flex align-items-center justify-content-center">
                    <div class="bg-white rounded px-3 py-4 w-100 h-100">
                        <div class="d-flex justify-content-between align-items-center h-100">
                            <div class="me-1">
                                <p class="m-0 mb-1 text-success fw-bold" style="font-size: 14px;">Total Transactions (MONTHLY)</p>
                                <h4 class="text-muted fs-6 m-0">{{$totalTransactionsMonthly}}</h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-file-invoice-dollar fa-xl" style="color: gray"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none d-md-flex flex-sm-row justify-content-between mb-3 flex-wrap">
            @foreach (['PENDING', 'INPROCESS', 'COMPLETED', 'CANCELED', 'FAILED', 'TROUBLE', 'ONHOLD'] as $status)
                <div>
                    @if ($selected == $status)
                        <a
                        href=""
                        class="text-decoration-none fw-bold w-100 mr-1 text-dark cursor-not-allowed border-2 border-black bg-none px-2 py-1 text-sm font-medium"
                        >
                            {{ $status }}
                        </a>
                    @else
                        <a
                        href="{{ route("admin-dashboard.page", array_merge(request()->query(), ["selected" => $status], ['page' => 1])) }}"
                        class="w-100 text-decoration-none text-dark mr-1 border-2 border-black px-2 py-1 text-sm font-medium hover:opacity-60"
                        >
                            {{ $status }}
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
        <!-- Select for mobile -->
        <div class="d-md-none mb-3">
            <div>
                <select 
                    class="form-select" 
                    onchange="location = this.value"
                    aria-label="Status Selection"
                >
                    @foreach (['PENDING', 'INPROCESS', 'COMPLETED', 'CANCELED', 'FAILED', 'TROUBLE', 'ONHOLD'] as $status)
                        <option 
                            value="{{ $selected == $status ? '' : route('admin-dashboard.page', array_merge(request()->query(), ['selected' => $status], ['page' => 1])) }}"
                            {{ $selected == $status ? 'selected' : '' }}
                        >
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-transaction-table
            :transactions="$transactions"
            :canUpdate="$canUpdate"
            :canDelete="$canDelete"
        />
    </div>
@endsection
