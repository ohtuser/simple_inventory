@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Order List</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered inv_list" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Order. No.</th>
                                <th>Date</th>
                                <th>T. Product</th>
                                <th title="Delivery Type">D. Type</th>
                                <th>Advance Info</th>
                                <th>Status</th>
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
                                    <td>
                                        @if ($l->delivery_type == 1)
                                            Home Delivery
                                        @else
                                            Pickup
                                        @endif
                                    </td>
                                    <td>
                                        Mode: {!! getPaymentMode($l->payment_mode, 1) !!} <br>
                                        Mobile: {{ $l->mobile }} <br>
                                        Amount: {{ $l->advance }}
                                    </td>
                                    <td>{!! getOrderStatus($l->status, 1) !!}</td>
                                    <td><a href="{{ route('customer.order.print', ['id' => $l->id]) }}"
                                            target="_blank">Print</a>
                                        @if ($l->status == 1)
                                            <a href="{{ route('customer.order.req_cancel', ['id' => $l->id]) }}"
                                                class="btn btn-sm btn-warning">Request Cancel</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
