@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header text-white bg-primay-blue">
        <h5>Admin Management</h5>
    </div>
    <div class="card-body">
      <div class="row">
          <div class="col-4">
              <div class="card">
                  <div class="card-header bg-orange text-white">
                      <h6>Add Admin/Stuff</h6>
                  </div>
                  <div class="card-body">
                      <form action="{{route('admin.user.store')}}" class="form_submit">
                          <div class="">
                              <label for="">Admin/Stuff</label>
                              <select name="type" id="" class="form-control select_2">
                                  <option value="1">Admin</option>
                                  <option value="2">Stuff</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="">Name</label>
                              <input type="text" name="name" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                        <button class="btn btn-orange btn-sm">Save</button>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-8">
            <div class="card commonListHolder">
                <div class="card-header bg-info text-white">
                    <h6>Admin/Stuff List</h6>
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
            getUser();
        });
        function getUser(){
            let data = {};
            customAjaxCall(function(res){
                console.log("res",res);
                $('.commonListBody').html(res.body);
                $('.commonListPaginate').html(res.paginate);
            },'GET',"{{route('admin.user.list')}}", data);
        }
    </script>

@endsection
