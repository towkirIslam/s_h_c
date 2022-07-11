@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Name</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.name') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="" value="{{ Auth::user()->name }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-upload"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.password') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Old Password</label>
                        <input type="password" class="form-control" name="old_password" id="">
                        @if (session('wrong_pass'))
                            <strong class="text-danger pt-2">{{ session('wrong_pass') }}</strong>
                        @endif

                        @if (session('same_pass'))
                            <strong class="text-danger pt-2">{{ session('same_pass') }}</strong>
                        @endif

                        @if (session('pass_success'))
                            <strong class="text-danger pt-2">{{ session('pass_success') }}</strong>
                        @endif


                        @error('old_password')
                            <strong class="text-danger pt-2">{{ $message }}</strong>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="">
                        @error('password')
                            <strong class="text-danger pt-2">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="">
                        @error('password_confirmation')
                            <strong class="text-danger pt-2">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-upload"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Photo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.photo') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="profile_photo">
                        @error('profile_photo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-upload"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</div>
@endsection
