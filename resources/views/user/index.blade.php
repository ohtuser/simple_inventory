@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
            <h5>Admin Management</h5>
            <button class="btn btn-sm btn-light" onclick="form_submit_reset()">Add Admin/Stuff</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-orange text-white">
                            <h6>Add Admin/Stuff</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" class="form_submit">
                                <input type="hidden" name="row_id" class="row_id">
                                <div class="">
                                    <label for="">Admin/Stuff</label>
                                    <select name="type" id="" class="form-control select_2 type">
                                        <option value="1">Admin</option>
                                        <option value="2">Stuff</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile</label>
                                    <input type="text" name="mobile" class="form-control mobile">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" cols="30" rows="2" class="form-control address"></textarea>
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
        $(document).ready(function() {
            getUser();
            $(document).on('click', '.btn_edit', function(e) {
                e.preventDefault();
                row_id = $(this).attr('data-row-id');
                editUser(row_id);
            });
        });

        function getUser() {
            getLoader();
            $('.row_id').val('');
            let data = {};
            customAjaxCall(function(res) {
                console.log("res", res);
                $('.commonListBody').html(res.body);
                $('.commonListPaginate').html(res.paginate);
            }, 'GET', "{{ route('admin.user.list') }}", data);
        }

        function editUser(row_id) {
            let data = {
                row_id
            };
            customAjaxCall(function(res) {
                console.log("res", res);
                $('.row_id').val(res.info.id);
                $('.type').val(res.info.user_type).change();
                $('.name').val(res.info.name);
                $('.email').val(res.info.email);
                $('.mobile').val(res.info.mobile);
                $('.address').text(res.info.address);
            }, 'GET', "{{ route('admin.user.edit') }}", data);
        }
    </script>
@endsection
