@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Order List</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered inv_list" id="dataTable">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Order. No.</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Total Product</th>
                                <th>Delivery Type</th>
                                <th>Status</th>
                                <th>Advance Info</th>
                                <th>Del. By</th>
                                <th>Order Cancel Charge</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $l)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $l->order_number }}</td>
                                    <td>{{ $l->orderedBy->name ?? '-' }}</td>
                                    <td>{{ date('d-m-Y', strtotime($l->created_at)) }}</td>
                                    <td>{{ count($l->getOrderDetails) }}</td>
                                    <td>
                                        @if ($l->delivery_type == 1)
                                            Home Delivery
                                        @else
                                            Pickup
                                        @endif
                                    </td>
                                    <td>{!! getOrderStatus($l->status, 1) !!}</td>
                                    <td>
                                        Mode: {!! getPaymentMode($l->payment_mode, 1) !!} <br>
                                        Mobile: {{ $l->mobile }} <br>
                                        Amount: {{ $l->advance }}
                                    </td>
                                    <td>{{ $l->deliveredBy->name ?? '-' }}</td>
                                    <td>
                                        @if ($l->status == 3)
                                            {{ $l->order_cancel_charge }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td><a href="{{ route('customer.order.print', ['id' => $l->id]) }}"
                                            target="_blank">Print</a>
                                        @if ($l->status == 1)
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('transaction.sell.create', ['order_id' => $l->id]) }}"
                                                target="_blank">Deliver</a>
                                        @endif

                                        @if ($l->status == 4)
                                            <button class="btn btn-sm btn-danger order_cancel"
                                                data-id="{{ $l->id }}">Cancel</button>
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


    <div class="modal" tabindex="-1" id="order_cancel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Cancel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.order.cancel') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="order_id" name="id">
                        <label for="">Order Cancel Charge</label>
                        <input type="number" value="0" class="form-control" name="order_cancel_charge">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-danger">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.order_cancel', function() {
                id = $(this).attr('data-id');
                $('#order_id').val(id);
                $('#order_cancel').modal('show');
            });
        });
    </script>
@endsection
