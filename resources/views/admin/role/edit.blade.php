@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Permission</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                                <input type="hidden" name="user_id" id=""  value="{{ $user->id }}">
                                <h3>{{ $user->name }}</h3>
                        </div>
                        <div class="mb-3">
                            <p>Permission Name</p>
                            @foreach ($permissions as $permission)
                                <input type="checkbox" {{ ($user->hasPermissionTo($permissions->name))?"Checked":'' }} name="permissions[]" id=""  value="{{ $permission->id }}"> {{ $permission->name }}
                                <br>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
