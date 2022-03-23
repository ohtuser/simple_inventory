@extends('layouts.master')

@section('css')

@endsection

@section('content')

    {{-- <div class="card-body"> --}}
      <div class="row">
          <div class="col-10">
              <div class="card">
                  <div class="card-header bg-info text-white">
                      <h6>Purchase</h6>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.unit.store')}}" class="form_submit">
                        {{-- <input type="hidden" name="row_id" class="row_id"> --}}

                        <div class="row mb-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Vendor</label>
                                    <select class="form-control vendor_search" name="vendor" id=""></select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="text" class="form-control flatpicker" value="{{ date('d-m-Y') }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Ref.Invoice</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Bill NO</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Bill Date</label>
                                    <input type="text" class="form-control flatpicker" value="{{ date('d-m-Y') }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Attach File</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row product_transaction_table">
                            @include('product.product_transaction', ['inv_settings'=>getInvoiceSettings(1)])
                        </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-2 custom-pl-0">
            <div class="card">
                @include('product.product_transaction_summary')
          </div>
      </div>
      <button onclick="addNewRow()" class="btn btn-success" style="position: fixed; top: 50%; right: 0; display: block;width: 40px;"><i class="fas fa-plus"></i></button>
@endsection

@section('js')

      <script>
          $(document).ready(function(){
            $(document).on('change', '.product_search', function(){
                product_id = $(this).val();
                row = $(this).attr('data-row');
                setProductInfo(product_id,row);
            });
          });
      </script>

@endsection
