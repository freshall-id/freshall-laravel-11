<div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-warning">
            <tr>
                @foreach (['Id', 'Code', 'Discount', 'Minimum Price', 'Max Discount', 'Expired Date', 'Quantity', 'Used', 'Last Modified','Action'] as $th)
                    <th style="min-width: 10vw">{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->id }}</td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->discountToNumberFormat()}}</td>
                    <td>{{ $voucher->minPriceToNumberFormat() }}</td>
                    <td>{{ $voucher->maxDiscountToNumberFormat()}}</td>
                    <td>{{ $voucher->expired_at }}</td>
                    <td>{{ $voucher->quantity }}</td>
                    <td>{{ $voucher->used }}</td>
                    <td>{{ $voucher->updated_at->format('d F Y H:i:s') }}</td>
                    <td>
                        <div class="d-flex flex-column gap-2 px-3">
                            {{-- button edit voucher --}}
                            <a href="{{ route('update-voucher.page', ['voucher' => $voucher]) }}"
                                class="btn btn-success btn-sm">
                                <i class="fa-solid fa-pen-to-square" style="color: white"></i>
                            </a>
                            {{-- button delete voucher --}}
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal"
                                data-title="Delete voucher"
                                data-content="Are you sure you want to delete Voucher ID: {{ $voucher->id }}?"
                                data-route="{{ route('delete-voucher.action', ['voucher' => $voucher]) }}"">
                                <i class="fa-solid fa-trash" style="color: white"></i>
                            </button>
                            {{-- Modal action --}}
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content text-start">
                                        <form id="editOrDeleteForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Modal Title</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close" style="background: #fff; border: none">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="modalContent">Modal Content</div>
                                                <div id="modalAction">
                                                    <div class="row row-cols-1 row-cols-sm-2 my-3">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success"
                                                    id="confirmButton">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No Voucher</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $vouchers->links() }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modal');
        const confirmButton = document.getElementById('confirmButton');
        const editOrDeleteForm = document.getElementById('editOrDeleteForm');

        // Function to check if current status and new status are the same
        function checkStatusMatch() {
            const currentStatus = document.querySelector(
                'select[aria-label="Current Status Selection"] option:checked').value;
            const newStatus = document.querySelector('select[name="new_status"] option:checked').value;

            if (currentStatus === newStatus) {
                confirmButton.disabled = true;
            } else {
                confirmButton.disabled = false;
            }
        }

        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            //Get Data from button
            const title = button.getAttribute('data-title');
            const content = button.getAttribute('data-content');
            const route = button.getAttribute('data-route');

            const modalTitle = modal.querySelector('.modal-title');
            const modalContent = modal.querySelector('#modalContent');
            const modelAction = modal.querySelector('#modalAction');

            //Update Modal's data
            modalTitle.textContent = title;
            modalContent.textContent = content;

            editOrDeleteForm.action = route;

            if (title.includes('Delete voucher')) {
                const hiddenMethodInput = document.querySelector('input[name="_method"]');
                hiddenMethodInput.value = 'DELETE';

                modelAction.classList.add('d-none');
                confirmButton.disabled = false;
                confirmButton.classList.remove('btn-success');
                confirmButton.classList.add('btn-danger');
                confirmButton.textContent = 'Delete';
            }
        });
    });
</script>
