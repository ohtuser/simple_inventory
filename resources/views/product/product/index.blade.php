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
                                <input type="text" name="local_name" class="form-control name">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Category</label>
                                        <select onchange="setSubCategory()" name="category" class="form-control product_category select_2">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Sub Category</label>
                                        <select name="sub_category" class="form-control product_sub_category select_2">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Brand</label>
                                        <select name="brand" class="form-control category select_2">
                                            @foreach ($brands as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="" class="rfl">Unit</label>
                                        <select name="unit" class="form-control category select_2">
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
                                        <input type="number" step="0.000001" value="0" name="buy_price" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Buy Price Code</label>
                                        <input type="text" name="buy_price_code" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Sell Price</label>
                                        <input type="number" step="0.000001" name="sell_price" value="0" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Sell Price Code</label>
                                        <input type="text" name="sell_price_code" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="" class="rfl">Reorder Level</label>
                                        <input type="number" step="0.000001" value="0" name="reorder_level" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Item Group</label>
                                        <select name="item_group" id="" class="form-control select_2">
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
                                        <input type="number" step="0.000001" name="product_code" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12 custom-pl-0">
                                        <label for="">Serial</label>
                                        <input type="text" name="serial" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="1" class="form-control"></textarea>
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
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            getProduct();
            setSubCategory();

            $(document).on('click','.btn_edit', function(e){
                e.preventDefault();
                row_id = $(this).attr('data-row-id');
                editUser(row_id);
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

        function editUser(row_id){
            let data = {row_id};
            customAjaxCall(function(res){
                console.log("res",res);
                $('.row_id').val(res.info.id);
                $('.name').val(res.info.name);
            },'GET',"{{route('admin.product.edit')}}", data);
        }
    </script>

@endsection

@include('product.product_common')
