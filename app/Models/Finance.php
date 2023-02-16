<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use HasFactory;
   
    use SoftDeletes;

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function currents()
    {
        return $this->hasMany(Current::class);
    }
}
