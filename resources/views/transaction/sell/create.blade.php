@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <form action="{{ route('transaction.store') }}" class="form_submit" method="post">
        {{-- <div class="card-body"> --}}
        @csrf
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6>Sell (Stock Out) @isset($order)
                                - Delivery
                            @endisset
                        </h6>
                    </div>
                    <div class="card-body">
                        {{-- <input type="hidden" name="row_id" class="row_id"> --}}
                        <input type="hidden" name="transaction_type" value="3" class="">
                        <input type="hidden" name="in_out" value="2" class="">
                        @isset($order)
                            <input type="hidden" value="{{ $order->id }}" name="order_id">
                        @endisset
                        <div class="row mb-3">

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Customer</label><br>
                                    @isset($order)
                                        <input type="hidden" name="party" value="{{ $order->party_id }}">
                                        {{ $order->orderedBy->name }}
                                    @endisset
                                    @empty($order)
                                        <select class="form-control customer_search" name="party" id=""></select>
                                    @endempty
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="text" name="date" class="form-control flatpicker"
                                        value="{{ date('d-m-Y') }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Ref.Invoice</label>
                                    <input type="text" name="ref_invoice" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="col-3">
                                <div class="form-group">
                                    <label for="">Attach File</label>
                                    <input type="text" name="attach" class="form-control">
                                </div>
                            </div> --}}
                        </div>

                        <div class="row product_transaction_table">
                            {{-- @isset($order) --}}
                            @include('product.product_transaction', [
                                'inv_settings' => getInvoiceSettings(3),
                            ])
                            {{-- @endisset --}}

                            {{-- @empty($order)
                                @include('product.product_transaction', [
                                    'inv_settings' => getInvoiceSettings(3),
                                ])
                            @endempty --}}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-2 custom-pl-0">
                <div class="card">
                    @include('product.product_transaction_summary')
                </div>
            </div>
        </div>
    </form>
    @empty($order)
        <button onclick="addNewRow()" class="btn btn-success"
            style="position: fixed; top: 50%; right: 0; display: block;width: 40px;"><i class="fas fa-plus"></i></button>
    @endempty
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('change', '.product_search', function() {
                product_id = $(this).val();
                row = $(this).attr('data-row');
                setProductInfo(product_id, row);
            });
        });
    </script>
@endsection
