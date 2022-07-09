@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Hospital Owner List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Added By</th>
                                <th>Owner Name</th>
                                <th>Owner NID</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($owners as $key=> $owner)
                                <tr>
                                    <td>{{ $owners->firstitem()+$key }}</td>
                                    <td>{{ $owner->rel_to_admin->name }}</td>
                                    <td>{{ $owner->name }}</td>
                                    <td>{{ $owner->nid }}</td>
                                    <td>{{ $owner->created_at->diffforHumans() }}</td>
                                    <td>
                                        <a href="{{ route('hospital.owners.delete', $owner->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $owners->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Register Hospital Owners</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('hospital.owners.insert') }}" method="post">
                        @csrf
                        <div class="mt-3">
                            <label for="" class="form-label">Owner Name</label>
                            <input type="text" class="form-control" name="name" id="">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Owner NID</label>
                            <input type="text" class="form-control" name="nid" id="">
                            @error('nid')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3" class="form-label">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="">
                            @error('confirm_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

@if (session('insert_success'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: '{{ session('insert_success') }}'
        })
    </script>
@endif

@if (session('pass_error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('pass_error') }}',

        })
    </script>
@endif

@if (session('delete_owner'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'warning',
        title: '{{ session('delete_owner') }}'
        })
    </script>
@endif

@endsection
