@if ($errors->any() && empty($disableToast))
    <div class="position-fixed p-0 m-0 w-75 text-truncate" style="z-index: 1000; right: 2rem; top: 2rem;">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ "Error: " . $error ?? "" }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    </div>
@endif

@session('error')
    <div class="position-fixed p-0 m-0 w-75 text-truncate" style="z-index: 1000; right: 2rem; top: 2rem;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ "Error: " . $value ?? "" }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endsession

@session('success')
    <div class="position-fixed p-0 m-0 w-75 text-truncate" style="z-index: 1000; right: 2rem; top: 2rem;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ "Success: " . $value ?? "" }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endsession
