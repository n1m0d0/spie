<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Finance extends Model implements Auditable
{
    use HasFactory;
   
    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function currents()
    {
        return $this->hasMany(Current::class);
    }

    public function consolidateds()
    {
        return $this->hasMany(Consolidated::class);
    }
}
