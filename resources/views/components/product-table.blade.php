<div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
        <thead class="table-warning">
            <tr>
                @foreach (['Id', 'SKU', 'Product Name', 'Product Image', 'Category', 'Stock', 'Minmum Buy', 'Weight', 'Price', 'Description', 'Total Sold', 'Rating', 'Last Modified', 'Action'] as $th)
                    <th style="min-width: 10vw">{{$th}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                @php
                    $price = App\Utils\Formatter::toNumberFormat($product->price);
                @endphp
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->sku}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                        <div class="ratio ratio-1x1">
                            <img src="{{$product->image}}" alt="product-image">
                        </div>
                    </td>
                    <td>{{$product->productCategory->label}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->minimum_buy}}</td>
                    <td>{{$product->weight}}</td>
                    <td>{{$price}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->total_sold}}</td>
                    <td>{{$product->rating}}</td>
                    <td>{{$product->updated_at->format("d F Y H:i:s")}}</td>
                    <td>
                        <div class="d-flex flex-column gap-2 px-3">
                            <a href="#productDetail.page" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                            </a>
                            {{-- button edit product --}}
                            <a href="{{ route('update-product.page', ['product'=>$product]) }}" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-pen-to-square" style="color: white"></i>
                            </a>
                            {{-- button delete product --}}
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-title="Delete product" data-content="Are you sure you want to delete product ID: {{ $product->id }}?" data-route="{{ route('delete-product.action', ['product'=>$product]) }}"">
                                <i class="fa-solid fa-trash" style="color: white"></i>
                            </button>
                            {{-- Modal action --}}
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content text-start">
                                        <form id="editOrDeleteForm" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Modal Title</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background: #fff; border: none">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="modalContent">Modal Content</div>
                                                <div id="modalAction">
                                                    <div class="row row-cols-1 row-cols-sm-2 my-3">
                                                        <div class="col mb-3 mb-sm-0">
                                                            <p class="m-0 mb-1">Current Status</p>
                                                            {{-- Select Current Status --}}
                                                            <select 
                                                                class="form-select" 
                                                                aria-label="Current Status Selection"
                                                                disabled
                                                            >
                                                                <option value="{{ $product->status }}" selected>
                                                                    {{ $product->status }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <p class="m-0 mb-1">New Status</p>
                                                            {{-- Select New status--}}
                                                            <select 
                                                                class="form-select" 
                                                                aria-label="New Status Selection"
                                                                name="new_status"
                                                            >
                                                                @foreach (['PENDING', 'INPROCESS', 'COMPLETED', 'CANCELED', 'FAILED', 'TROUBLE', 'ONHOLD'] as $option)
                                                                    <option value="{{ $option }}" {{ $option === $product->status ? 'selected' : '' }}>
                                                                        {{ $option }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="confirmButton">Confirm</button>
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
                    <td colspan="10" class="text-center">No products</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $products->links() }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modal');
        const confirmButton = document.getElementById('confirmButton');
        const editOrDeleteForm = document.getElementById('editOrDeleteForm');

        // Function to check if current status and new status are the same
        function checkStatusMatch() {
            const currentStatus = document.querySelector('select[aria-label="Current Status Selection"] option:checked').value;
            const newStatus = document.querySelector('select[name="new_status"] option:checked').value;

            if (currentStatus === newStatus) {
                confirmButton.disabled = true;
            } else {
                confirmButton.disabled = false;
            }
        }

        modal.addEventListener('show.bs.modal', function (event) {
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

            if (title.includes('Delete product')) {
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