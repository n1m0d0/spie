<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Territory extends Model implements Auditable
{
    use HasFactory;

    use SoftDeletes;

    use \OwenIt\Auditing\Auditable;

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }
}
