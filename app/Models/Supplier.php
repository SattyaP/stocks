<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name_supplier',
        'address',
        'phone',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_supplier', 'supplier_id', 'item_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
