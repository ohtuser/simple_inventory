@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
        <h5>Product Management</h5>
        <button class="btn btn-sm btn-light" onclick="form_submit_reset()">Add Product</button>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-4">
              <div class="card mt-0">
                  <div class="card-header bg-info text-white">
                      <h6>Add Product</h6>
                  </div>
                  <div class="card-body pt-0 pb-1" style="max-width: ">
                        <form action="{{route('admin.product.store')}}" class="form_submit">
                            <input type="hidden" name="row_id" class="row_id">
                            <div class="form-group">
                                <label for="" class="rfl">Name</label>
                                <input type="text" name="name" class="form-control name">
                            </div>
                            <div class="form-group">
                                <label for="">Local Name</label>
                                <input type="text" name="local_name" class="form-control local_name">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Category</label>
                                        <select onchange="setSubCategory()" name="category" class="form-control category select_2 product_category">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Sub Category</label>
                                        <select name="sub_category" class="form-control sub_category select_2 product_sub_category">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Brand</label>
                                        <select name="brand" class="form-control brand select_2">
                                            @foreach ($brands as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="" class="rfl">Unit</label>
                                        <select name="unit" class="form-control unit select_2">
                                            @foreach ($units as $u)
                                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Buy Price</label>
                                        <input type="number" step="0.000001" value="0" name="buy_price" class="form-control buy_price">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Buy Price Code</label>
                                        <input type="text" name="buy_price_code" class="form-control buy_price_code">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Sell Price</label>
                                        <input type="number" step="0.000001" name="sell_price" value="0" class="form-control sell_price">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Sell Price Code</label>
                                        <input type="text" name="sell_price_code" class="form-control sell_price_code">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Reorder Level</label>
                                        <input type="number" step="0.000001" value="0" name="reorder_level" class="form-control reorder_level">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Item Group</label>
                                        <select name="item_group" id="" class="form-control select_2 item_group">
                                            <option value="1">Consumeable</option>
                                            <option value="">Service</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="">Product Code</label>
                                        <input type="number" step="0.000001" name="product_code" class="form-control product_code">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Serial</label>
                                        <input type="text" name="serial" class="form-control serial">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="1" class="form-control description"></textarea>
                            </div>
                            <button class="btn btn-info btn-sm btn-block mt-1 text-white">Save</button>
                        </form>
                  </div>
              </div>
          </div>
          <div class="col-8">
            <div class="card mt-0 commonListHolder">
                <div class="card-header bg-orange text-white">
                    <h6>Product List</h6>
                </div>
                <div class="card-body commonListBody">

                </div>
                <div class="commonListPaginate"></div>
            </div>
          </div>
      </div>
    </div>
</div>

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
                {{-- <form action="{{ route('customer.review.post') }}" class="form_submit">
                    <input type="hidden" id="product_id" name="product_id">
                    <input id="input-21b" value="4" type="text" class="rating" data-theme="krajee-fas"
                        data-min=0 data-max=5 data-step=0.2 data-size="xs" title="" name="rating">
                    <div class="clearfix"></div>
                    <textarea type="text" name="comments" style="width: 100%" class="form-control ml-3"
                        placeholder="Write product experience here..."></textarea>
                    <button type="submit" class="btn btn-sm btn-success mt-2">Post</button>
                </form> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- @include('') --}}
@include('product.product_common')
@include('layouts.common')
@endsection

@section('js')
    <script>
        var force_sub_category = null;
        $(document).ready(function(){
            getProduct();
            setSubCategory();

            $(document).on('click','.btn_edit', function(e){
                e.preventDefault();
                row_id = $(this).attr('data-row-id');
                editProduct(row_id);
            });
        });
        function getProduct(){
            getLoader();
            $('.row_id').val('');
            let data = {};
            customAjaxCall(function(res){
                console.log("res",res);
                $('.commonListBody').html(res.body);
                $('.commonListPaginate').html(res.paginate);
            },'GET',"{{route('admin.product.list')}}", data);
        }

        function editProduct(row_id){
            let data = {row_id};
            customAjaxCall(function(res){
                console.log("res",res);
                $('.row_id').val(res.info.id);
                $('.name').val(res.info.name);
                $('.local_name').val(res.info.local_name);
                $('.category').val(res.info.category).change();
                $('.brand').val(res.info.brand).change();
                // console.log(res.info.category);
                $('.unit').val(res.info.unit).change();
                $('.buy_price').val(res.info.buy_price);
                $('.buy_price_code').val(res.info.buy_price_code);
                $('.sell_price').val(res.info.sell_price);
                $('.sell_price_code').val(res.info.sell_price_code);
                $('.reorder_level').val(res.info.reorder_level);
                $('.item_group').val(res.info.item_group).change();
                $('.product_code').val(res.info.product_code);
                $('.serial').val(res.info.serial);
                $('.description').val(res.info.description);
                force_sub_category = res.info.sub_category;
            },'GET',"{{route('admin.product.edit')}}", data);
        }

        function getReviews(product_id) {
            console.log("qewrqweqwe");
            customAjaxCall(function(res) {
                console.warn(res);
                $('#exampleModal').modal('show');
                $('.reviews').html(res.html);
            }, 'get', "{{ route('customer.reviews') }}", {
                product_id
            })
        }
    </script>

@endsection


