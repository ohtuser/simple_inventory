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
                    <h6>Amount Transaction</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('reports.inv_reports.journals') }}" method="get">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">S.Date</label>
                                    <input type="text" class="flatpicker form-control" name="sdate"
                                        @if (request()->sdate) value="{{ date('d-m-Y', strtotime(request()->sdate)) }}"
                                @else
                                    value="{{ date('d-m-Y') }}" @endif>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">S.Date</label>
                                    <input type="text" class="flatpicker form-control" name="edate"
                                        @if (request()->edate) value="{{ date('d-m-Y', strtotime(request()->edate)) }}"
                                    @else
                                        value="{{ date('d-m-Y') }}" @endif>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Party</label>
                                    <select name="party" class="form-control select_2">
                                        <option value="">All</option>
                                        @foreach ($parties as $p)
                                            <option
                                                @if (request()->party) @if (request()->party == $p->id) selected @endif
                                                @endif value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">&nbsp;</label>
                                <button class="btn btn-sm btn-success d-block">Filter</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-hover table-bordered mt-3">
                        <thead>
                            <tr class="bg-dark text-light">
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Ref. Inv.</th>
                                <th>Party</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cr = 0;
                                $db = 0;
                            @endphp
                            @foreach ($list as $key => $l)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('d-M-Y', strtotime($l->created_at)) }}</td>
                                    <th>{{ $l->getInvoice->invoice_no }}</th>
                                    <td>{{ $l->getParty->name }}</td>
                                    <td>{{ $l->dr_cr == 2 ? $l->amount : '-' }}</td>
                                    <td>{{ $l->dr_cr == 1 ? $l->amount : '-' }}</td>
                                    @php
                                        if ($l->dr_cr == 2) {
                                            $db += $l->amount;
                                        } else {
                                            $cr += $l->amount;
                                        }
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th>{{ $db }}</th>
                                <th>{{ $cr }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
