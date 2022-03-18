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

                        <div class="row">
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
                        <button class="btn btn-info btn-sm">Save</button>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-2 custom-pl-0">
            <div class="card commonListHolder">
                <div class="card-header bg-orange text-white">
                    <h6>Total</h6>
                </div>
                <div class="card-body commonListBody">

                </div>
                <div class="commonListPaginate"></div>
            </div>
          </div>
      </div>

@endsection

@section('js')

@endsection
