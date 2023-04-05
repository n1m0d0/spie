<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    public function childrenEntities()
    {
        return $this->hasMany(Entity::class)->with('entities');
    }
}
