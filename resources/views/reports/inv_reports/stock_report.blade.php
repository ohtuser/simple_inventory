@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Stock Report</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.inv_reports.stock_report') }}" method="get">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category" id="" class="select_2 d-block" style="width: 100%">
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
                            <div class="col">
                                <div class="form-group">
                                    <label for="">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-success btn-sm">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Available Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $l)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $l->name }}</td>
                                    <td>{{ $l->getUnit->name }}</td>
                                    <td>{{ $l->getStock->avail ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
