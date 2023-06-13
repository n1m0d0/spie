<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Planning extends Model implements Auditable
{
    use HasFactory;

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function territories()
    {
        return $this->hasMany(Territory::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function childrenPlannings()
    {
        return $this->hasMany(Planning::class)->with('plannings');
    }

    public function observations()
    {
        return $this->belongsToMany(observation::class);
    }
}
