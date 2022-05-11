@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h6>Due Report</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Inv. No</th>
                                <th>Payable</th>
                                <th>Paid</th>
                                <th>Due</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 0;
                            @endphp
                            @foreach ($invoice->groupBy('party_id') as $key => $invoices)
                                <tr>
                                    <td colspan="5" class="bg-dark text-light text-center">
                                        {{ $invoices[0]->get_party->name }}</td>
                                </tr>
                                @foreach ($invoices as $inv)
                                    <tr>
                                        <td>{{ ++$sl }}</td>
                                        <td>{{ $inv->invoice_no }}</td>
                                        <td>{{ $inv->payable }}</td>
                                        <td>{{ $inv->pay }}</td>
                                        <td>{{ $inv->due }}</td>
                                        {{-- <td>{{  }} --}}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="table-secondary text-center"><b>Total</b></td>
                                    <td class="bg-dark text-light text-center"><b>{{ $invoices->sum('due') }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
