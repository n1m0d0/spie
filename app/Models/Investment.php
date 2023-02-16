<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function finance()
    {
        return $this->belongsTo(Finance::class);
    }
}
