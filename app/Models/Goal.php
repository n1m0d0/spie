<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function hub()
    {
        return $this->belongsTo(Hub::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
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
