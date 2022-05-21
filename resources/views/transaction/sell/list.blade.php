@extends('layouts.master')

@section('css')
    <style>
        .inv_list th,
        .inv_list td {
            text-align: center;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Sell List</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered inv_list" id="dataTable">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Inv. No.</th>
                                <th>Inv. Date</th>
                                <th>Vendor</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $l)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $l->invoice_no }}</td>
                                    <td>{{ date('d-m-Y', strtotime($l->date)) }}</td>
                                    <td>{{ $l->get_party->name }}</td>
                                    <td>{{ $l->grand_total }}</td>
                                    <td>{{ $l->discount }}</td>
                                    <td>{{ $l->payable }}</td>
                                    <td>{{ $l->pay }}</td>
                                    <td>{{ $l->due }}</td>
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
