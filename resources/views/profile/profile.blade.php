@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-white bg-primay-blue justify-content-between d-flex">
            <h5>Profile</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-orange text-white">
                            <h6>Update Profile</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile_update') }}" class="form_submit">
                                <input type="hidden" name="row_id" class="row_id">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control email">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" name="password" class="form-control">
                                    <span>**Password Will Not Change When This Feild Blank</span>
                                </div>
                                <button class="btn btn-orange btn-sm">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
