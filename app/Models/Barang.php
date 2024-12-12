<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'deskripsi',
        'image',
        'status',
    ];

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class);
    }

    // public function getHargaBeliAttribute($value)
    // {
    //     return 'Rp ' . number_format($value, 0, ',', '.');
    // }

    // public function getHargaJualAttribute($value)
    // {
    //     return 'Rp ' . number_format($value, 0, ',', '.');
    // }

    public function getImageAttribute($value)
    {
        return asset('/storage/barangs/' . $value);
    }

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Tersedia' : 'Tidak Tersedia';
    }
}
