@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Order List</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered inv_list">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Order. No.</th>
                                <th>Date</th>
                                <th>Total Product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $l)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $l->order_number }}</td>
                                    <td>{{ date('d-m-Y', strtotime($l->created_at)) }}</td>
                                    <td>{{ count($l->getOrderDetails) }}</td>
                                    <td><a href="{{ route('transaction.print', ['id' => $l->id]) }}"
                                            target="_blank">Print</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
