<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    public function rel_to_admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function rel_hospital_owner()
    {
        return $this->belongsTo(HospitalOwner::class, 'owner_id');
    }

}
