<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planning extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
