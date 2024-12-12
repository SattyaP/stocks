<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuans';
    protected $fillable = [
        'nama_satuan',
    ];

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class);
    }
}
