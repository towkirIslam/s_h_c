<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalOwner as RequestsHospitalOwner;
use App\Models\HospitalOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalOwnersController extends Controller
{

    public function index()
    {
        $owners = HospitalOwner::paginate(3);
        return view('admin.hospital_owners.index', compact('owners'));
    }

    public function insert(RequestsHospitalOwner $request)
    {

        if($request->confirm_password != $request->password){
            return back()->with('pass_error', 'Confirm Pasword did not match');
        }

        $hospitalowner = new HospitalOwner;
        $hospitalowner->created_by = Auth::id();
        $hospitalowner->name = $request->name;
        $hospitalowner->nid = $request->nid;
        $hospitalowner->password = $request->password;
        $hospitalowner->confirm_password = $request->confirm_password;
        $hospitalowner->save();
        return back()->with('insert_success', 'Hospital Owner Registar Successfully!');
    }

    public function delete($id)
    {
        HospitalOwner::find($id)->delete();
        return back()->with('delete_owner','Hospital Owner Removed Successfully');
    }


    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'nid'=>'required',
            'confirm_password'=>'required',
            'password'=>'required',
            'old_pass'=>'required',

        ]);

        $id = $request->hidden_id;
        $hospitalowner = HospitalOwner::where('id', $id)->first();
        $old_data_pass = $hospitalowner->password;
        $old_pass_request = $request->old_pass;

        if($old_data_pass != $old_pass_request){
            return back()->with('update_old_pass_errr', 'Old Password did not match');
        }

        $hospitalowner->name = $request->name;
        $hospitalowner->nid = $request->nid;
        if($request->password != $request->confirm_password){
            return back()->with('pass_error', 'Confirm Pasword did not match');
        }
        $hospitalowner->password = $request->password;
        $hospitalowner->save();
        return back();

    }

}
