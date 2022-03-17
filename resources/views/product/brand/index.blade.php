@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
        <h5>Brand Management</h5>
        <button class="btn btn-sm btn-light" onclick="form_submit_reset()">Add Brand</button>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-4">
              <div class="card">
                  <div class="card-header bg-orange text-white">
                      <h6>Add Brand</h6>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.brand.store')}}" class="form_submit">
                        <input type="hidden" name="row_id" class="row_id">
                          <div class="form-group">
                              <label for="">Name</label>
                              <input type="text" name="name" class="form-control name">
                          </div>
                        <button class="btn btn-orange btn-sm">Save</button>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-8">
            <div class="card commonListHolder">
                <div class="card-header bg-info text-white">
                    <h6>Brand List</h6>
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
            getBrand();
            $(document).on('click','.btn_edit', function(e){
                e.preventDefault();
                row_id = $(this).attr('data-row-id');
                editUser(row_id);
            });
        });
        function getBrand(){
            getLoader();
            $('.row_id').val('');
            let data = {};
            customAjaxCall(function(res){
                console.log("res",res);
                $('.commonListBody').html(res.body);
                $('.commonListPaginate').html(res.paginate);
            },'GET',"{{route('admin.brand.list')}}", data);
        }

        function editUser(row_id){
            let data = {row_id};
            customAjaxCall(function(res){
                console.log("res",res);
                $('.row_id').val(res.info.id);
                $('.name').val(res.info.name);
            },'GET',"{{route('admin.brand.edit')}}", data);
        }
    </script>

@endsection
