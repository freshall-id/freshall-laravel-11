@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="container-fluid">
            <div class="row mb-3">
                @foreach (['PENDING', 'INPROCESS', 'COMPLETED', 'CANCELED', 'FAILED', 'TROUBLE', 'ONHOLD'] as $status)
                    <div class="col">
                        @if ($selected == $status)
                            <a
                            href=""
                            class="mr-1 text-dark cursor-not-allowed border-2 border-black bg-black px-2 py-1 text-sm font-medium"
                            >
                            {{ $status }}
                            </a>
                        @else
                            <a
                            href="{{ route("admin-dashboard.page", array_merge(request()->query(), ["selected" => $status], ['page' => 1])) }}"
                            class="text-decoration-none text-dark mr-1 border-2 border-black px-2 py-1 text-sm font-medium hover:opacity-60"
                            >
                            {{ $status }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
            <x-transaction-table
                :transactions="$transactions"
                :canUpdateOrDelete="true"
            />
        </div>
    </div>
@endsection