<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['unit_name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
