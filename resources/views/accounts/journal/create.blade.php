@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
            <h5>Amount Transaction</h5>
            <div>
                <a href="{{ route('reports.inv_reports.journals') }}" class="btn btn-sm btn-light">Amount Transaction
                    List</a>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="form-group">
                            <span for="">Invoice</span>
                            <select name="type" id="invoice_id" class="form-control select_2">
                                @foreach ($invoices as $i)
                                    <option value="{{ $i->id }}">{{ $i->invoice_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-sm btn-success mt-1" onclick="findInfo()">Find Info</button>
                    </div>
                </div>
                <div class="col-4 invoice_info">

                </div>
                <div class="col-4 journal_posting" style="display: none;">
                    <form action="{{ route('journal.store') }}">
                        <input type="hidden" name="invoice_id" id="invoice_id">
                        <label for="">Pay</label>
                        <input type="number" class="form-control" id="pay">
                        <button class="form-control btn btn-sm">Store</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function findInfo() {
            let id = $('#invoice_id').val();
            customAjaxCall(function(res) {
                $('.invoice_info').html(res.html);
                $('.journal_posting').show();
                $('#invoice_id').val(id);
                $('#pay').val(res.due);
            }, 'GET', "{{ route('invoice_info') }}", {
                id
            })
        }
    </script>
@endsection

@section('js')
@endsection
