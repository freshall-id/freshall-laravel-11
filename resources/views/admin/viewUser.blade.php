@extends('layouts.admin')

@section('content')
    <div class="my-5">
        <h2 class="fw-bold">Manage User</h2>
    </div>
    <x-user-table :users="$users" />
@endsection
