<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\HospitalOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function index()
    {
        $hospital_owners = HospitalOwner::all();
        $hospitals = Hospital::paginate(5);
        return  view('admin.hospital.index', [
            'hospital_owners' => $hospital_owners,
            'hospitals' => $hospitals,
        ]);
    }

    public function insert(Request $request)
    {
        $hospitals = new Hospital();
        $hospitals->owner_id = $request->owner_name;
        $hospitals->created_by = Auth::id();
        $hospitals->hospital_id = $request->hospital_id;
        $hospitals->hospital_name = $request->hospital_name;
        $hospitals->save();
        return back()->with('insert_success','Hospital Regiater Successfully');
    }

    public function delete($id)
    {
        Hospital::find($id)->delete();
        return back()->with('delete_msz', 'Hospital Deleted Successfully');
    }
}
