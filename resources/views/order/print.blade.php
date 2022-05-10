<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <title>Order Print</title>
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
    <div class="col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                {{-- <a class="pt-2 d-inline-block" href="index.html" data-abc="true">BBBootstrap.com</a> --}}
                <div class="float-left">
                    <h3 class="mb-0">Order No: {{ $order_info->order_number }}</h3>
                    <p class="mb-0"><b>Customer:</b> {{ $order_info->orderedBy->name }}</p>
                    <p class="mb-0"><b>Date:</b> {{ date('d M, Y', strtotime($order_info->created_at)) }}</p>
                    <p class="mb-0"><b>Status:</b> {!! getOrderStatus($order_info->status, 1) !!}</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <h4 class="text-center">Order Invoice</h4>
                    <table class="table table-striped">
                        <thead>
                            <th class="text-center">Sl</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Qty</th>
                        </thead>
                        <tbody>
                            @php
                                $total_discount = 0;
                                $subtotal = 0;
                            @endphp
                            @foreach ($order_info->getOrderDetails as $key => $t)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $t->getProduct->name }}</td>
                                    <td class="text-center">{{ $t->getProduct->getUnit->name }}</td>
                                    <td class="text-center">{{ $t->getProduct->getBrand->name }}</td>
                                    <td class="text-center">{{ $t->qty }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-center">Total</td>
                                <td class="text-center">{{ $order_info->getOrderDetails->sum('qty') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
