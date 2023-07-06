<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aim extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function pointers()
    {
        return $this->hasMany(Pointer::class);
    }
}
