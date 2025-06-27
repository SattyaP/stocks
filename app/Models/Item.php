<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_code',
        'item_name',
        'stock_quantity',
        'purchase_price',
        'image',
        'status',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'item_supplier', 'item_id', 'supplier_id');
    }

    public function getImageAttribute($value)
    {
        return asset('/storage/' . $value);
    }

    public function scopeLowStock($query, $threshold = 10)
    {
        return $query->where('stock_quantity', '<', $threshold);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('status', 'empty');
    }
}
