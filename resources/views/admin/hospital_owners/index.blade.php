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
                                        <a type="button" class="btn btn-primary edit__information" data__id="{{ $owner->id }}" data__owner__name="{{ $owner->name }}"  data__nid="{{ $owner->nid }}">Edit</a>
                                        <button name="{{ route('hospital.owners.delete', $owner->id) }}" class="btn btn-danger delete">Delete</button>
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
                    <form id="SubmitForm" action="{{ route('hospital.owners.insert') }}" method="post">
                        @csrf
                        <input type="hidden" id="Id_InformationId" name="hidden_id" value="">
                        <div class="mt-3">
                            <label for="" class="form-label">Owner Name</label>
                            <input type="text" class="form-control" name="name" id="Id_OwnerName" value="">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Owner NID</label>
                            <input type="text" class="form-control" name="nid" id="Id_OwnerNid" value="">
                            @error('nid')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="Password" value="">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3" class="form-label">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="ConfirmPassword" value="" >
                            @error('confirm_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button id="RegisterButton" type="submit" class="btn btn-primary">Register</button>
                            <button id="UpdateRegisterButton" type="submit" class="btn btn-primary">Update</button>
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
        Swal.fire(
            'Deleted!',
            '{{ session('delete_owner') }}',
            'success'
            )
    </script>
@endif

<script>
    $('.delete').click(function(){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var link = $(this).attr('name');
            window.location.href = link;

        }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $("#UpdateRegisterButton").hide();
        $(".edit__information").click(function(e){
            e.preventDefault();
        var InformationId = $(this).attr('data__id');
        var OwnerName = $(this).attr('data__owner__name');
        var OwnerNid = $(this).attr('data__nid');
        $("#Id_InformationId").val(InformationId);
        $("#Id_OwnerName").val(OwnerName);
        $("#Id_OwnerNid").val(OwnerNid);
        $("#RegisterButton").hide();
        $("#UpdateRegisterButton").show();
        $('#SubmitForm').attr('action', "{{ route('hospital.owners.update') }}");

});
});

</script>

@endsection

{{-- href="{{ route('hospital.owners.delete', $owner->id) }}" --}}
