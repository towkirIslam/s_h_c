@extends('layouts.dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Register Doctors</h3>
                </div>

                <div class="card-body">
                    <form id="SubmitForm" action="{{ route('doctors.insert') }}" method="post">
                        @csrf
                        <input type="hidden" id="Id_InformationId" name="hidden_id" value="">
                        <div class="mt-3">
                            <label for="" class="form-label">Hospital Name</label>
                            <select name="hospital_name" id="HospitalName" class="form-control">
                                <option value="">-- Select Hospital --</option>
                                @foreach ($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}">{{ $hospital->hospital_name }}</option>
                                @endforeach
                            </select>
                            @error('hospital_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="" class="form-label">Doctor Name</label>
                            <input type="text" class="form-control" name="doctor_name" id="DoctorId" value="">
                            @error('doctor_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="" class="form-label">Doctor ID</label>
                            <input type="text" class="form-control" name="doctor_id" id="DoctorId" value="">
                            @error('doctor_id')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3" class="form-label">
                            <label for="">Depertment</label>
                            <input type="text" class="form-control" name="depertment" id="Depertment" value="" >
                            @error('depertment')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mt-3" class="form-label">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="Depertment" value="" >
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mt-3" class="form-label">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="Depertment" value="" >
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

        <div class="col-lg-12">
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
                                <th>Hospital Id</th>
                                <th>Doctor Name</th>
                                <th>Doctor Id</th>
                                <th>Depertment</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dostors as $key=> $dostor)
                                <tr>
                                    <td>{{ $dostors->firstitem()+$key }}</td>
                                    <td>{{ $dostor->rel_to_admin->name }}</td>
                                    <td>{{ $dostor->rel_to_hospital->hospital_name }}</td>
                                    <td>{{ $dostor->doctor_name }}</td>
                                    <td>{{ $dostor->doctor_id }}</td>
                                    <td>{{ $dostor->depertment }}</td>
                                    <td>{{ $dostor->created_at->diffforHumans() }}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary edit__information shadow btn-xs sharp mr-1" data__hospital__name="{{ $hospital->hospital_name }}" data__hospital_nid="{{ $hospital->hospital_id }}"><i class="fa fa-pencil"></i></a>
                                        <button name="" class="btn btn-danger delete shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $dostors->links() }}
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

@if (session('delete_msz'))
    <script>
        Swal.fire(
            'Deleted!',
            '{{ session('delete_msz') }}',
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
            var HospitalNameVar = $(this).attr('data__hospital__name');
            var HospitalIdVar = $(this).attr('data__hospital__name');

            $("#HospitalName").val(HospitalNameVar);
            $("#HospitalId").val(HospitalIdVar);

            $("#RegisterButton").hide();
            $("#UpdateRegisterButton").show();
            $('#SubmitForm').attr('action', "{{ route('hospital.update') }}");
        });
    });

</script>

@endsection
