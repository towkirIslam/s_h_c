@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Role List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Roles</th>
                        <th>Permissions</th>

                    </tr>
                    <tr>
                        @foreach ($roles as $key=> $role)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <ul>
                                        @foreach ($role->getPermissionNames() as $key=> $permission)
                                            <li>{{ $permission }}</li>
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h3>User List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        @foreach ($users as $key=> $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <ul>
                                        @foreach ($user->getRoleNames() as $key=> $role)
                                            <li>{{ $role }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('edit.permission', $user->id ) }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Permissions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.submit') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="permission_name" id="" class="form-control" placeholder="Permission Name">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Permissions</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Add Role</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('role.submit') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="role_name" id="" class="form-control" placeholder="Role Name">
                    </div>
                    <div class="mb-3">
                        @foreach ($permissions as $permission)
                            <input type="checkbox" name="permissions[]" id=""  value="{{ $permission->id }}"> {{ $permission->name }}
                            <br>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Permissions</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Assign Role To User</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('assign.role') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select name="user_id" class="form-control" id="">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="role_id" class="form-control" id="">
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Assign Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
