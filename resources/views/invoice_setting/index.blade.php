@extends('layouts.master')
@section('title','PRINT EDITOR')
@section ('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('invoice_setting/summernote/summernote.css')}}" />
    <link rel="stylesheet" href="{{ asset('invoice_setting/summernote/summernote-bs3.css')}}" />
    <link rel="stylesheet" href="{{ asset('invoice_setting/codemirror/lib/codemirror.css')}}" />
    <link rel="stylesheet" href="{{ asset('invoice_setting/codemirror/theme/monokai.css')}}" />
    <script src="{{asset('invoice_setting/modernizr/modernizr.js')}}"></script>
@endsection
<style>
    .note-editor .note-editable{
        box-shadow: inset -1px 4px 10px 0px rgb(212 212 212);
        font-size: 14px !important;
    }
    .note-editor .note-toolbar{
        background-color: #155f4d !important;
        /* #181819 */
    }
    .note-editor .note-statusbar .note-resizebar {
        background-color: #155f4d !important;
        /* #181819 */
    }
    .modal-content {
        position: fixed !important;
    }
</style>
    <div class="card sina-card" style="background:#f6f6f6 !important; ">
        <div class="card-header card-header-s d-flex flex-wrap align-items-center mb-2">
            <h4 class="col-4 pl-0">Print View Editor</h4>
            <div  class="col-5 pr-0">
                <form  id="form" method="get" action="{{ route('invoice_setting') }}" name="form">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <label for="type" class="pr-2">Type</label>
                        <select class="form-control select_2" name="id" id="type" onchange="this.form.submit()">
                            @forelse ($invoice_type as $d)
                                <option value="{{$d->id}}" {{$item->id == $d->id ? 'selected' : ''}}>{{$d->invoice_name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="cart-body">
            <form  id="form" method="Post" action="{{ route("invoice_setting_store") }}" name="form" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center pb-3">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Fraction Digit</label>
                            <input type="text" class="form-control" name="fraction_digit" value="{{ $item->fraction_digit }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Invoice Prefix</label>
                            <input type="text" class="form-control" name="invoice_prefix" value="{{ $item->invoice_prefix }}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center pb-3">
                    <input type="hidden" name="id" id="" value="{{$item->id}}">
                    <div class="col-md-11 px-0">
                        <label for="">Style CSS Class</label>
                        <textarea class="form-control" name="style_css" id="style_css" >{{$item->custom_css}}</textarea>
                    </div>
                    <div class="col-md-11 px-0 my-4">
                        <label for="">Invoice Header</label>
                        <textarea class="summernote" name="print_head" id="print_head" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }'>{{$item->invoice_header}}</textarea>
                    </div>

                    <div class="col-md-11 px-0 my-4 ">
                        @php($pfs = explode(',',$item->posting_field_show))
                        @php($pfl = explode(',',($item->posting_field_label ? $item->posting_field_label : ',,,,,,,,,,,,,,')))
                        <label for="">Settings (Invoice Create)</label>
                        <section class=" border border-primary p-2">
                            <div class="d-flex flex-wrap">
                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="name_local" title="1">Product Name (Local)</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="name_local" {{ in_array(1, $pfs) ? 'checked' : '' }} value="1">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[0] ? $pfl[0] : 'Product Name (Local)'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="available_qty" title="2">Available Qty</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="available_qty" {{ in_array(2, $pfs) ? 'checked' : '' }} value="2">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[1] ? $pfl[1] : 'Available Qty'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="unit" title="3">Unit</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="unit" {{ in_array(3, $pfs) ? 'checked' : '' }} value="3">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[2] ? $pfl[2] : 'Unit'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="description" title="3">Description</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="description" {{ in_array(4, $pfs) ? 'checked' : '' }} value="4">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[3] ? $pfl[3] : 'Description'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="product_details_button" title="3">Product Details Button</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="product_details_button" {{ in_array(5, $pfs) ? 'checked' : '' }} value="5">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[4] ? $pfl[4] : 'Details' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="buy_price" title="3">Buy Price</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="buy_price" {{ in_array(6, $pfs) ? 'checked' : '' }} value="6">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[5] ? $pfl[5] : 'Buy Price' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="buy_price_code" title="3">Buy Price Code</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="buy_price_code" {{ in_array(7, $pfs) ? 'checked' : '' }} value="7">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[6] ? $pfl[6] : 'Buy Price Code' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="sell_price" title="3">Sell Price</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="sell_price" {{ in_array(8, $pfs) ? 'checked' : '' }} value="8">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[7] ? $pfl[7] : 'Sell Price' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="sell_price_code" title="3">Sell Price Code</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="sell_price_code" {{ in_array(9, $pfs) ? 'checked' : '' }} value="9">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[8] ? $pfl[8] : 'Buy Price Code' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="discount_percentage" title="3">Discount(%)</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="discount_percentage" {{ in_array(10, $pfs) ? 'checked' : '' }} value="10">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[9] ? $pfl[9] : 'Discount(%)' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="discount_manual" title="3">Manual Discount</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="discount_manual" {{ in_array(11, $pfs) ? 'checked' : '' }} value="11">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[10] ? $pfl[10] : 'Manual Discount' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class="" for="product_code" title="3">Product Code</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="product_code" {{ in_array(12, $pfs) ? 'checked' : '' }} value="12">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[11] ? $pfl[11] : 'Product Code' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class="" for="last_purchase_history" title="3">Last Purchase History</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="posting_field_show[]" id="last_purchase_history" {{ in_array(13, $pfs) ? 'checked' : '' }} value="13">
                                        <input type="text" style="width: 90%" class="form-control" name="posting_field_label[]" id="" value="{{ $pfl[12] ? $pfl[12] : 'Last Purchase History' }}">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>



                    <div class="col-md-11 px-0 my-4 ">
                        @php($ifs = explode(',',$item->invoice_print_field_show))
                        @php($ifl = explode(',',($item->invoice_print_field_show_label ? $item->invoice_print_field_show_label : ',,,,,,,,,,,,,,,,,,,,,,,,,,,')))
                        <label for="">Settings (Invoice Print)</label>
                        <section class=" border border-primary p-2">
                            <div class="d-flex flex-wrap">
                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_name" title="1">Product Name</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_name" {{ in_array(1, $ifs) ? 'checked' : '' }} value="1">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[0] ? $ifl[0] : 'Product Name'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_name_local" title="1">Product Name (Local)</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_name_local" {{ in_array(2, $ifs) ? 'checked' : '' }} value="2">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[1] ? $ifl[1] : 'Product Name (Local)'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class="" for="i_product_code" title="3">Product Code</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_product_code" {{ in_array(3, $ifs) ? 'checked' : '' }} value="3">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[2] ? $ifl[2] : 'Manual Discount' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_unit" title="3">Unit</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_unit" {{ in_array(4, $ifs) ? 'checked' : '' }} value="4">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[3] ? $ifl[3] : 'Unit'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_price" title="2">Price</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_price" {{ in_array(5, $ifs) ? 'checked' : '' }} value="5">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[4] ? $ifl[4] : 'Price'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_qty" title="2">Qty</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_qty" {{ in_array(6, $ifs) ? 'checked' : '' }} value="6">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[5] ? $ifl[5] : 'Qty'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_total" title="2">Total (Before Discount)</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_total" {{ in_array(7, $ifs) ? 'checked' : '' }} value="7">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[6] ? $ifl[6] : 'Total'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_discount" title="3">Discount</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_discount" {{ in_array(8, $ifs) ? 'checked' : '' }} value="8">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[7] ? $ifl[7] : 'Discount' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_net_total" title="3">Net Total</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_net_total" {{ in_array(9, $ifs) ? 'checked' : '' }} value="9">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[8] ? $ifl[8] : 'Net Total' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_available_qty" title="2">Available Qty</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_available_qty" {{ in_array(10, $ifs) ? 'checked' : '' }} value="10">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[9] ? $ifl[9] : 'Available Qty'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_description" title="3">Description</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_description" {{ in_array(11, $ifs) ? 'checked' : '' }} value="11">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[10] ? $ifl[10] : 'Description'  }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_buy_price" title="3">Buy Price</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_buy_price" {{ in_array(12, $ifs) ? 'checked' : '' }} value="12">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[11] ? $ifl[11] : 'Buy Price' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_buy_price_code" title="3">Buy Price Code</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_buy_price_code" {{ in_array(13, $ifs) ? 'checked' : '' }} value="13">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[12] ? $ifl[12] : 'Buy Price Code' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_sell_price" title="3">Sell Price</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_sell_price" {{ in_array(14, $ifs) ? 'checked' : '' }} value="14">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[13] ? $ifl[13] : 'Sell Price' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_sell_price_code" title="3">Sell Price Code</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_sell_price_code" {{ in_array(15, $ifs) ? 'checked' : '' }} value="15">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[14] ? $ifl[14] : 'Sell Price Code' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class="" for="i_last_purchase_history" title="3">Last Purchase History</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_last_purchase_history" {{ in_array(16, $ifs) ? 'checked' : '' }} value="16">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[15] ? $ifl[15] : 'Last Purchase History' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_product_details_button" title="3">Balance</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_product_details_button" {{ in_array(17, $ifs) ? 'checked' : '' }} value="17">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[16] ? $ifl[16] : 'Balance' }}">
                                    </div>
                                </div>

                                <div class="col-md-3 form-check mt-2">
                                    <label class=" " for="i_in_words" title="3">In Words</label> <br>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="invoice_print_field_show[]" id="i_in_words" {{ in_array(18, $ifs) ? 'checked' : '' }} value="18">
                                        <input type="text" style="width: 90%" class="form-control" name="invoice_print_field_label[]" id="" value="{{ $ifl[17] ? $ifl[17] : 'In Words' }}">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-11 px-0">
                        <label for="">Invoice Footer</label>
                        <textarea class="summernote" name="print_foot" id="print_foot" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }'>{{$item->invoice_footer}}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center pb-3">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <div class="modal modals fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Demo Code</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea style="width: 500px; height: 500px" name="demo" id="demo" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
{{-- For Editor --}}
<script src="{{asset('invoice_setting/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/addon/selection/active-line.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/addon/edit/matchbrackets.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/mode/javascript/javascript.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
<script src="{{asset('invoice_setting/codemirror/mode/css/css.js')}}"></script>
<script src="{{asset('invoice_setting/summernote/summernote.js')}}"></script>
<script src="{{asset('invoice_setting/more_js_files/theme.js')}}"></script>
<script src="{{asset('invoice_setting/more_js_files/theme.custom.js')}}"></script>
<script src="{{asset('invoice_setting/more_js_files/theme.init.js')}}"></script>
<script src="{{asset('invoice_setting/more_js_files/forms/examples.advanced.form.js')}}"></script>

<script type="text/javascript" src="{{ asset('invoice_setting/invoice-parameter.js') }}"></script>

@endsection
