@extends('layouts.master')

@section('css')
    <style>
        th,
        td {
            text-align: center;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Order Create</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($categories as $c)
                                <tr class="table-secondary">
                                    <td colspan="6" class="text-center" style="font-weight: 900">{{ $c->name }}</td>
                                </tr>
                                @foreach ($c->getSubCategory as $sub)
                                    @if (count($sub->getProductsSubCatWise) > 0)
                                        <tr class="table-secondary">
                                            <td colspan="6" class="text-center">{{ $sub->name }}</td>
                                        </tr>
                                        @foreach ($sub->getProductsSubCatWise as $product)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->getBrand->name }}</td>
                                                <td>{{ $product->getUnit->name }}</td>
                                                <td>{{ $product->sell_price }}</td>
                                                <td style="width: 200px"><input value="0" min="0.00001" step="0.00001"
                                                        type="number" class="form-control"></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-success" style="position: fixed; right: 0; top: 50">Make Order</button>
@endsection
