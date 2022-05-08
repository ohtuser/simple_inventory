@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Order Create</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <tbody>
                            @foreach ($categories as $c)
                                <tr>
                                    <td>{{ $c->name }}</td>
                                </tr>
                                @foreach ($c->getSubCategory as $sub)
                                    <tr>
                                        <td>{{ $sub->name }}</td>
                                    </tr>
                                    @foreach ($sub->getProductsSubCatWise as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
