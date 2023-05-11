<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approach extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function type()
    {
        return $this->belongsTo(type::class);
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostic::class);
    }
}
