<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Invoice Print</title>
    <style>
        body {
            background-color: #000
        }

        .padding {
            padding: 2rem !important
        }

        .card {
            margin-bottom: 30px;
            border: none;
            -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
            box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e6e6f2
        }

        h3 {
            font-size: 20px
        }

        h5 {
            font-size: 15px;
            line-height: 26px;
            color: #3d405c;
            margin: 0px 0px 15px 0px;
            font-family: 'Circular Std Medium'
        }

        .text-dark {
            color: #3d405c !important
        }

    </style>
</head>

<body>
    @php
        $pfs = $content->invoice_print_field_show != '' ? explode(',', $content->invoice_print_field_show) : explode(',', ',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,');
        $pfsl = explode(',', $content->invoice_print_field_show_label);
    @endphp
    <div class="col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                {{-- <a class="pt-2 d-inline-block" href="index.html" data-abc="true">BBBootstrap.com</a> --}}
                <div class="float-right">
                    @if ($inv->ref_invoice)
                        <h3>Ref Invoice:
                            {{ getRefInvoice($inv->ref_invoice_model, $inv->ref_invoice, 'order_number') }}</h3>
                    @endif
                </div>
                <div class="float-left">
                    <h3 class="mb-0">Invoice: {{ $inv->invoice_no }}</h3>
                    Date: {{ date('d M, Y', strtotime($inv->date)) }}
                </div>

            </div>
            <div class="card-body">
                {!! $content->invoice_header !!}
                <div class="table-responsive-sm">

                    <table class="table table-striped">
                        <thead>
                            <th class="text-center">Sl</th>
                            {{-- name --}}
                            @if (in_array(1, $pfs))
                                <th>{{ $pfsl[0] }}</th>
                            @endif
                            {{-- local name --}}
                            @if (in_array(2, $pfs))
                                <th>{{ $pfsl[1] }}</th>
                            @endif
                            {{-- code --}}
                            @if (in_array(3, $pfs))
                                <th>{{ $pfsl[2] }}</th>
                            @endif
                            {{-- unit --}}
                            @if (in_array(4, $pfs))
                                <th>{{ $pfsl[3] }}</th>
                            @endif
                            {{-- desc --}}
                            @if (in_array(11, $pfs))
                                <th>{{ $pfsl[10] }}</th>
                            @endif
                            {{-- buy price --}}
                            @if (in_array(12, $pfs))
                                <th>{{ $pfsl[11] }}</th>
                            @endif
                            {{-- buy price code --}}
                            @if (in_array(13, $pfs))
                                <th>{{ $pfsl[12] }}</th>
                            @endif
                            {{-- sell price --}}
                            @if (in_array(14, $pfs))
                                <th>{{ $pfsl[13] }}</th>
                            @endif
                            {{-- sell price code --}}
                            @if (in_array(15, $pfs))
                                <th>{{ $pfsl[14] }}</th>
                            @endif
                            {{-- avail qty --}}
                            @if (in_array(10, $pfs))
                                <th>{{ $pfsl[9] }}</th>
                            @endif
                            {{-- qty --}}
                            @if (in_array(6, $pfs))
                                <th>{{ $pfsl[5] }}</th>
                            @endif
                            {{-- price --}}
                            @if (in_array(5, $pfs))
                                <th>{{ $pfsl[4] }}</th>
                            @endif
                            {{-- total (before discount) --}}
                            @if (in_array(7, $pfs))
                                <th>{{ $pfsl[6] }}</th>
                            @endif
                            {{-- discount --}}
                            @if (in_array(8, $pfs))
                                <th>{{ $pfsl[7] }}</th>
                            @endif
                            {{-- Net Total --}}
                            @if (in_array(9, $pfs))
                                <th>{{ $pfsl[8] }}</th>
                            @endif
                        </thead>
                        <tbody>
                            @php
                                $total_discount = 0;
                                $subtotal = 0;
                            @endphp
                            @foreach ($inv->get_transactions as $key => $t)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    {{-- name --}}
                                    @if (in_array(1, $pfs))
                                        <td>{{ $t->product->name }}</td>
                                    @endif
                                    {{-- local name --}}
                                    @if (in_array(2, $pfs))
                                        <td>{{ $t->product->local_name }}</td>
                                    @endif
                                    {{-- code --}}
                                    @if (in_array(3, $pfs))
                                        <td>{{ $t->product->product_code }}</td>
                                    @endif
                                    {{-- unit --}}
                                    @if (in_array(4, $pfs))
                                        <td>{{ $t->product->getUnit->name }}</td>
                                    @endif
                                    {{-- desc --}}
                                    @if (in_array(11, $pfs))
                                        <td>{{ $t->description }}</td>
                                    @endif
                                    {{-- buy price --}}
                                    @if (in_array(12, $pfs))
                                        <td>{{ $t->product->buy_price }}</td>
                                    @endif
                                    {{-- buy price code --}}
                                    @if (in_array(13, $pfs))
                                        <td>{{ $t->product->buy_price_code }}</td>
                                    @endif
                                    {{-- sell price --}}
                                    @if (in_array(14, $pfs))
                                        <td>{{ $t->product->sell_price }}</td>
                                    @endif
                                    {{-- sell price code --}}
                                    @if (in_array(15, $pfs))
                                        <td>{{ $t->product->sell_price_code }}</td>
                                    @endif
                                    {{-- avail qty --}}
                                    @if (in_array(10, $pfs))
                                        <th>{{ $t->product->getStock ? $t->product->getStock->avail : 'N/A' }}</th>
                                    @endif
                                    {{-- qty --}}
                                    @if (in_array(6, $pfs))
                                        <td>{{ $t->quantity }}</td>
                                    @endif
                                    {{-- price --}}
                                    @if (in_array(5, $pfs))
                                        <td>{{ $t->price }}</td>
                                    @endif
                                    {{-- total (before discount) --}}
                                    @php
                                        $before_discount = $t->price * $t->quantity;
                                        $subtotal += $before_discount;
                                    @endphp
                                    @if (in_array(7, $pfs))
                                        <td>{{ $before_discount }}</td>
                                    @endif
                                    {{-- discount --}}
                                    @php
                                        $discount = $t->dc_amount * $t->quantity;
                                        $total_discount += $discount;
                                    @endphp
                                    @if (in_array(8, $pfs))
                                        <td>{{ $discount }}</td>
                                    @endif
                                    {{-- Net Total --}}
                                    @if (in_array(9, $pfs))
                                        <th>{{ $t->price_after_discount * $t->quantity }}</th>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear" style="table-layout: auto">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark text-right d-block">Subtotal : </strong>
                                    </td>
                                    <td class="right">{{ $subtotal }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark text-right d-block">Discount : </strong>
                                    </td>
                                    <td class="right">{{ $total_discount }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark text-right d-block">Payable : </strong>
                                    </td>
                                    <td class="right">
                                        <strong class="text-dark">{{ $subtotal - $total_discount }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                {!! $content->invoice_footer !!}
            </div>
        </div>
    </div>
</body>

</html>
