<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalOwner extends Model
{
    use HasFactory;

    public function rel_to_admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
