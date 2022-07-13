<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorControllers extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();
        $dostors = Doctor::paginate(5);
        return view('admin.doctors.index', [
            'hospitals'=> $hospitals,
            'dostors' => $dostors,
        ]);
    }

    public function insert(Request $request)
    {

        $request->validate([
            'doctor_id' => 'required',
            'doctor_name' => 'required',
            'depertment' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($request->confirm_password != $request->password){
            return back()->with('pass_error', 'Confirm Pasword did not match');
        }

        $doctors = new Doctor;
        $doctors->hospital_id = $request->hospital_name;
        $doctors->doctor_id = $request->doctor_id;
        $doctors->doctor_name = $request->doctor_name;
        $doctors->depertment = $request->depertment;
        $doctors->password = $request->password;
        $doctors->created_by = Auth::id();
        $doctors->save();
        return back()->with('insert_success','Doctor Register Successfully!');

    }
}
