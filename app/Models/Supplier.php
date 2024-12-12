<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon',
        'email',
        'status',
    ];

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class);
    }
}
