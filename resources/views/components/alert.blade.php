@if ($errors->any())
    <div class="toast position-fixed bg-danger" style="opacity: 1; z-index: 100; right: 1rem; top: 1rem;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Warning</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-light">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

@if (session("error"))
    <div class="toast position-fixed bg-danger fade" style="opacity: 1; z-index: 100; right: 1rem; top: 1rem;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Warning</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-light">
            {{ session("error") }}
        </div>
    </div>
@endif

@if (session("success"))
    <div class="toast position-fixed bg-success" style="opacity: 1; z-index: 100; right: 1rem; top: 1rem;" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-light">
            {{ session("success") }}
        </div>
    </div>
@endif

<script>
    var closeBtns = document.querySelectorAll(".btn-close");
    closeBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            var toasts = document.querySelectorAll(".toast");
            toasts.forEach(function (toast) {
                toast.remove();
            });
        });
    });
</script>