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
        $hospitalowner->confirm_password= $request->confirm_password;
        $hospitalowner->save();
        return back()->with('insert_success', 'Hospital Owner Registar Successfully!');
    }

    public function delete($id)
    {
        HospitalOwner::find($id)->delete();
        return back()->with('delete_owner','Hospital Owner Removed Successfully');
    }
}
