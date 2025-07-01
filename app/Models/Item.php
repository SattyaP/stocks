<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['item_code', 'item_name', 'purchase_price', 'image', 'unit_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getImageAttribute($value)
    {
        return asset('/storage/' . $value);
    }

    public function getPurchasePriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
}
