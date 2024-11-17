@extends('app')

@section('content')
    <div class="container mt-5">
        <x-transaction-table
            :tableTitle="'All Transaction'"
            :transactions="$transactions"
            :transactionHeaders="['Id', 'Customer Name', 'Price Total', 'Status', 'Date', 'Notes', 'Action']"
            :canUpdateOrDelete = "true"
        />
    </div>
@endsection

@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp