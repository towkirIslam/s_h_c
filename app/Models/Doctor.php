<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';


    public function rel_to_admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function rel_to_hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }



}
