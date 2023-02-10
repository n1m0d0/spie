<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }
    
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value)
        );
    }
}
