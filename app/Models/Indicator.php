<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Indicator extends Model implements Auditable
{
    use HasFactory;

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;
    
    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function dissociations()
    {
        return $this->belongsToMany(Dissociation::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function pointers()
    {
        return $this->belongsToMany(Pointer::class);
    }
}
