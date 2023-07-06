<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pointer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function aim()
    {
        return $this->belongsTo(Aim::class);
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class);
    }
}
