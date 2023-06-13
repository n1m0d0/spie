<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostic extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function approach()
    {
        return $this->belongsTo(Approach::class);
    }
}
