<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $table = 'stok_barangs';
    protected $fillable = [
        'barang_id',
        'supplier_id',
        'satuan_id',
        'stok',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
