@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
            <h5>Profile Update Req. List</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Addres</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($requests as $key => $r)
                    <td>{{ $key + 1 }}</td>
                    <th width="5%"><img style="max-width: 100%" src="{{ asset('images/' . $r->image) }}" alt=""></th>
                    <td><span class="text-success fw-bold">Updated</span><br> <span class="text-danger">Previous</td>
                    <td><span class="text-success fw-bold">{{ $r->name }} </span><br> <span
                            class="text-danger">{{ $r->userInfo->name }} </span></td>
                    <td><span class="text-success fw-bold">{{ $r->email }} </span><br> <span
                            class="text-danger">{{ $r->userInfo->email }} </span></td>
                    <td><span class="text-success fw-bold">{{ $r->mobile }} </span><br> <span
                            class="text-danger">{{ $r->userInfo->mobile }} </span></td>
                    <td><span class="text-success fw-bold">{{ $r->address }} </span><br> <span
                            class="text-danger">{{ $r->userInfo->address }} </span></td>
                    <td>
                        <a href="{{ route('profile_update_request_approve', ['id' => $r->userInfo->id]) }}"
                            class="btn btn-sm btn-success">Approve</a>
                        <a href="{{ route('profile_update_request_cancel', ['id' => $r->userInfo->id]) }}"
                            class="btn btn-sm btn-danger">Cancel</a>
                    </td>
                @endforeach
            </table>
        </div>
    </div>
@endsection
