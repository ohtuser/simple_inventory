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
                            @if (user()->user_type != 1 && user()->user_type != 2)
                            @endif
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile_update') }}" class="form_submit">
                                <div style="width: 100px">
                                    @if (user()->image)
                                        <img style="width: 100%;" src="{{ asset('images/' . user()->image) }}" alt="">
                                    @else
                                        <img style="width: 100%;" src="{{ asset('profile.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image" value="" class="form-control">
                                </div>
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
                                    <label for="">Mobile</label>
                                    <input type="text" name="mobile" value="{{ $user->mobile }}"
                                        class="form-control mobile">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" cols="30" rows="2" class="form-control address">{{ $user->address }}</textarea>
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
                @if ($user->getProfileUpdateRequest)
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-orange text-white">
                                <h6>Profile Update Request</h6>
                            </div>
                            <div class="card-body">
                                <div style="width: 100px">
                                    @if ($user->getProfileUpdateRequest->image)
                                        <img style="width: 100%;"
                                            src="{{ asset('images/' . $user->getProfileUpdateRequest->image) }}" alt="">
                                    @else
                                        <img style="width: 100%;" src="{{ asset('profile.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <strong for="">Name: </strong>
                                    <span>{{ $user->getProfileUpdateRequest->name }}</span>
                                </div>
                                <div class="form-group">
                                    <strong for="">Email: </strong>
                                    <span>{{ $user->getProfileUpdateRequest->email }}</span>
                                </div>
                                <div class="form-group">
                                    <strong for="">Mobile: </strong>
                                    <span>{{ $user->getProfileUpdateRequest->mobile }}</span>
                                </div>
                                <div class="form-group">
                                    <strong for="">Address: </strong>
                                    <span>{{ $user->getProfileUpdateRequest->address }}</span>
                                </div>
                                <a href="{{ route('profile_update_request_cancel') }}"
                                    class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
