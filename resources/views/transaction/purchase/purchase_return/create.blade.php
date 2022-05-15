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
                        <h6>Purchase Return (Stock Out)</h6>
                    </div>
                    <div class="card-body">
                        {{-- <input type="hidden" name="row_id" class="row_id"> --}}
                        <input type="hidden" name="transaction_type" value="2" class="">
                        <input type="hidden" name="in_out" value="2" class="">
                        <div class="row mb-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <select class="form-control vendor_search" name="party" id=""></select>
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
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Bill NO</label>
                                    <input type="text" name="bill_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Bill Date</label>
                                    <input type="text" name="bill_date" class="form-control flatpicker"
                                        value="{{ date('d-m-Y') }}">
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
                            @include('product.product_transaction', [
                                'inv_settings' => getInvoiceSettings(2),
                            ])
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
    <button onclick="addNewRow()" class="btn btn-success"
        style="position: fixed; top: 50%; right: 0; display: block;width: 40px;"><i class="fas fa-plus"></i></button>
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
