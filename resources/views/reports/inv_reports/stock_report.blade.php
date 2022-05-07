@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6>Stock Report</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="" id="" class="select_2 d-block" style="width: 100%">
                                @foreach ($categories as $c)
                                    <p>{{ $c->name }} 
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @foreach ($c->getSubCategory as $subc)
                                        <option value="{{ $subc->id }}"> - {{ $subc->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Product</label>
                            <select class="form-control product_search" name="product" id=""></select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="text" name="date" class="form-control flatpicker" value="{{ date('d-m-Y') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
