@extends('layouts.master')

@section('css')
    <link href="{{ asset('rating/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('rating/krajee-fas/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('rating/krajee-svg/theme.css') }}">
    <!--suppress JSUnresolvedLibraryURL -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <style>
        th,
        td {
            text-align: center;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <form action="{{ route('customer.order.store') }}" class="form_submit">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex bg-info text-white justify-content-between">
                        <h6>Order Create</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="">Delivery Type</label>
                                <select name="delivery_type" class="form-control select_2" style="width: 100%">
                                    <option value="1">Home Delivery</option>
                                    <option value="2">Pickup</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Payment Mode</label>
                                <select name="payment_mode" class="form-control select_2" style="width: 100%">
                                    @foreach (getPaymentMode() as $key => $pm)
                                        <option value="{{ $key }}">{{ $pm }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile" value="{{ user()->mobile }}">
                            </div>
                            <div class="col">
                                <label for="">Advance</label>
                                <input type="number" class="form-control" name="advance" value="0">
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($categories as $c)
                                    <tr class="bg-secondary text-light">
                                        <td colspan="6" class="text-center" style="font-weight: 400">{{ $c->name }}
                                        </td>
                                    </tr>
                                    @foreach ($c->getSubCategory as $sub)
                                        @if (count($sub->getProductsSubCatWise) > 0)
                                            <tr class="table-secondary">
                                                <td colspan="6" class="text-center">{{ $sub->name }}</td>
                                            </tr>
                                            @foreach ($sub->getProductsSubCatWise as $product)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td>
                                                        {{ $product->name }}
                                                        @if (count($product->getRating) > 0)
                                                            (<i class="fas fa-star"></i>
                                                            {{ round($product->getRating->sum('rating') / $product->getRating->count(), 2) }})
                                                        @endif
                                                        <br>
                                                        <button type="button" data-id="{{ $product->id }}"
                                                            class="btn btn-sm btn-info text-light review_button">Review</button>
                                                    </td>
                                                    <td>{{ $product->getBrand->name }}</td>
                                                    <td>{{ $product->getUnit->name }}</td>
                                                    <td>{{ $product->sell_price }}</td>
                                                    <td style="width: 200px"><input
                                                            name="product_qty[{{ $product->id }}]" value="0" min="0"
                                                            step="0.00001" type="number" class="form-control"></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-success" style="position: fixed; right: 0; top: 50%">Make Order</button>

                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('layouts.common')


    {{-- Models --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="reviews">

                    </div>
                    <form action="{{ route('customer.review.post') }}" class="form_submit">
                        <input type="hidden" id="product_id" name="product_id">
                        <input id="input-21b" value="4" type="text" class="rating" data-theme="krajee-fas"
                            data-min=0 data-max=5 data-step=0.2 data-size="xs" title="" name="rating">
                        <div class="clearfix"></div>
                        <textarea type="text" name="comments" style="width: 100%" class="form-control ml-3"
                            placeholder="Write product experience here..."></textarea>
                        <button type="submit" class="btn btn-sm btn-success mt-2">Post</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('rating/star-rating.js') }}" type="text/javascript"></script>
    <script src="{{ asset('rating/krajee-fas/theme.js') }}"></script>
    <script src="{{ asset('rating/krajee-svg/theme.js') }}"></script>
    <script>
        $('.select_2').select2();

        $('.review_button').click(function() {
            let product_id = $(this).attr('data-id');
            $('#product_id').val(product_id);
            $('#exampleModal').modal('show');
            getReviews(product_id);
        })

        function getReviews(product_id) {
            customAjaxCall(function(res) {
                console.warn(res);
                $('.reviews').html(res.html);
            }, 'get', "{{ route('customer.reviews') }}", {
                product_id
            })
        }
    </script>
@endsection
