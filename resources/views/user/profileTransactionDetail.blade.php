@extends('layouts.dashboard')

@section('content')
    <div class="d-flex align-items-center flex-column">
        <div class="col-8 mt-3 border rounded">
            <div class="bg-warning container-fluid pt-2 pb-2 rounded-top d-flex justify-content-between align-items-center">
                <h1>Transaction Detail</h1>
                <a href="{{ route('profileTransactions.page') }}"><i class="fa-solid fa-arrow-left text-black me-3"
                        style="font-size: 40px"></i></a>
            </div>
            <div class="p-3 pt-0">
                <div class="d-flex justify-content-between mt-4">
                    <h2>Status</h2>
                    <h3
                        class="
                @if ($transactionHeader->status === 'COMPLETED') text-success 
                @elseif (in_array($transactionHeader->status, ['PENDING', 'INPROCESS', 'ONHOLD'])) text-warning 
                @elseif (in_array($transactionHeader->status, ['CANCELED', 'FAILED', 'TROUBLE'])) text-danger @endif
                ">
                        {{ $transactionHeader->status }}
                    </h3>

                </div>

                <div class="d-flex justify-content-between">
                    <h5>
                        Invoice
                    </h5>
                    <p style="margin: 0%;padding:0%;">
                        {{ $transactionHeader->invoice_number }}
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <h5>
                        Tanggal pembuatan pesanan
                    </h5>
                    <p style="margin: 0%;padding:0%;">
                        {{ $transactionHeader->created_at }}
                    </p>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <h2>Status Pengiriman</h2>
                    <h3
                        class="
                @if ($transactionHeader->shipping_status === 'DELIVERED') text-success 
                @elseif (in_array($transactionHeader->shipping_status, ['WAITING', 'SHIPPED', 'INPROCESS'])) text-warning 
                @elseif (in_array($transactionHeader->shipping_status, ['LOST', 'DAMAGED', 'RETURNED'])) text-danger @endif
                ">
                        {{ $transactionHeader->shipping_status }}
                </div>
                <div class="d-flex justify-content-between">
                    <h5>
                        Servis Pengiriman
                    </h5>
                    <p style="margin: 0%;padding:0%;">
                        {{ $transactionHeader->shipping_provider }}
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <h5>
                        Resi
                    </h5>
                    <p style="margin: 0%;padding:0%;">
                        {{ $transactionHeader->shipping_receipt_number }}
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <h5>
                        Alamat
                    </h5>
                    <p style="margin: 0%;padding:0%;">
                        {{ $transactionHeader->userAddress->full_address }}
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <h5>
                        Penerima
                    </h5>
                    <p style="margin: 0%;padding:0%;">
                        {{ $transactionHeader->user->name }}
                    </p>
                </div>

                <div class="d-flex justify-content-between flex-column border-top pt-2 pb-2 mt-4">
                    <h3>
                        Catatan
                    </h3>
                    <h5 style="font-weight:normal;margin: 0%;">
                        {{ $transactionHeader->notes ?? 'No Notes' }}
                    </h5>
                </div>

                <div class="border-top border-bottom align-items-center d-flex justify-content-center flex-column pb-4"
                    style="gap: 0%;padding:0%;">
                    <div class="col-12 align-items-center d-flex flex-column">
                        @foreach ($transactionHeader->transactionDetails as $detail)
                            <div class="col-12 d-flex justify-content-between mt-4" style="margin:0%;padding:0%;">
                                <div class="d-flex flex-row">
                                    <div class="border me-4">
                                        <img src="{{ asset($detail->product->image) }}"
                                            alt="" style="width:100px;height:100px;">
                                    </div>
                                    <div>
                                        <h3 style="margin: 0%;">{{ $detail->product->name }}</h3>
                                        <h4 style="margin: 0%;font-weight: normal;">{{ $detail->quantity }}x</h4>
                                    </div>
                                </div>
                                <h5 class="align-self-end" style="margin: 0%;font-weight: normal;">
                                    {{ $transactionHeader->priceToNumberFormat($detail->product->price) }}
                                </h5>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <table class="table p-5" style="padding-left: 20px; margin-left: auto;">
                        <colgroup>
                            <col style="width: 70%;">
                            <col style="width: 30%;">
                        </colgroup>
                        <thead class="table-warning">
                            <tr class="text-end">
                                <th scope="col">
                                    <p style="margin:0%">Tipe Biaya</p>
                                </th>
                                <th scope="col">
                                    <p style="margin:0%">Jumlah</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-end">
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Subtotal Produk</p>
                                </td>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">
                                        {{ $transactionHeader->priceToNumberFormat($transactionHeader->price_items) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Subtotal Pengiriman</p>
                                </td>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">
                                        {{ $transactionHeader->priceToNumberFormat($transactionHeader->price_shipping) }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Asuransi Barang</p>
                                </td>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">
                                        {{ $transactionHeader->priceToNumberFormat($transactionHeader->price_insurance) }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Biaya Jasa Aplikasi</p>
                                </td>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">
                                        {{ $transactionHeader->priceToNumberFormat($transactionHeader->price_fee) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Diskon 'Code :
                                        {{ $transactionHeader->voucher->code ?? '' }}'</p>
                                </td>
                                <td>
                                    <p class="text-success" style="font-weight: normal;margin:0%;">
                                        -{{ $transactionHeader->priceToNumberFormat($transactionHeader->price_items) ?? $transactionHeader->priceToNumberFormat(0) }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4 style="margin:0%;">Total Harga</h4>
                                </td>
                                <td>
                                    <h4 style="margin:0%;">
                                        {{ $transactionHeader->priceToNumberFormat($transactionHeader->price_total) }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Payment Status</p>
                                </td>
                                <td>
                                    <p class="
                                    @if ($transactionHeader->payment_status === 'PAID') text-success 
                                    @elseif (in_array($transactionHeader->payment_status, ['PENDING', 'WAITING'])) text-warning 
                                    @elseif (in_array($transactionHeader->payment_status, ['FAILED', 'REFUNDED', 'CANCELED'])) text-danger @endif"
                                        style="font-weight: normal;margin:0%;">
                                        {{ $transactionHeader->payment_status }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">Metode Pembayaran</p>
                                </td>
                                <td>
                                    <p style="font-weight: normal;margin:0%;">{{ $transactionHeader->payment_method }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
