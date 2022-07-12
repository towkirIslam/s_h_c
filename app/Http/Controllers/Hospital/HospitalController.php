<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\HospitalOwner;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospital_owners = HospitalOwner::all();

        return  view('admin.hospital.index', [
            'hospital_owners' => $hospital_owners,
        ]);
    }
}
