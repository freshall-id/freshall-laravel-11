<div class="container-fluid">
    <h2 class="mb-4">{{$tableTitle}}</h2>
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-warning">
                <tr>
                    @foreach ($transactionHeaders as $th)
                        <th>{{$th}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->user->name}}</td>
                        <td>{{$transaction->price_total}}</td>
                        <td>{{$transaction->status}}</td>
                        <td>{{$transaction->created_at}}</td>
                        <td style="max-width: 10vw; overflow: hidden; text-overflow: ellipsis;">
                            {{ $transaction->notes ? $transaction->notes : '-' }}
                        </td>
                        <td>
                            <div class="d-flex flex-column align-items-start gap-3">
                                <a href="#transactionDetail.page" class="btn btn-primary btn-sm">View Detail</a>
                                @if ($canUpdateOrDelete)
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-title="Edit Status Transaction" data-content="Edit status for transaction ID: {{ $transaction->id }}" data-route="#editTransactionStatus.action">Edit Status</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-title="Delete Transaction" data-content="Are you sure you want to delete transaction ID: {{ $transaction->id }}?" data-route="#deleteTransaction.action">Delete Transaction</button>
                                @endif
                            </div>
                        </td>
                    </tr>                     
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Transactions</td>
                    </tr>
                @endforelse

                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Modal Title</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="modalContent">Modal Content</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="#" class="btn btn-danger" id="confirmButton">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modal');
        const confirmButton = document.getElementById('confirmButton');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            //Get Data from button
            const title = button.getAttribute('data-title');
            const content = button.getAttribute('data-content');
            const route = button.getAttribute('data-route');

            const modalTitle = modal.querySelector('.modal-title');
            const modalContent = modal.querySelector('#modalContent');
            
            //Update Modal's data
            modalTitle.textContent = title;
            modalContent.textContent = content;

            confirmButton.href = route;
        });
    });
</script>