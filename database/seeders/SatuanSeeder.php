<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuans = [
            'pcs',
            'box',
            'set',
            'kg',
            'gr',
            'mg',
            'ton',
            'kwintal',
            'kw',
            'kwh',
            'm',
            'cm',
            'mm',
            'km',
            'inch',
            'ft',
            'yard',
            'liter',
            'ml',
            'galon',
            'oz',
            'lb',
            'ton',
            'kwintal',
            'kw',
            'kwh',
            'm',
            'cm',
            'mm',
            'km',
            'inch',
            'ft',
            'yard',
            'liter',
            'ml',
            'galon',
            'oz',
            'lb',
        ];

        foreach ($satuans as $satuan) {
            Satuan::create([
                'nama_satuan' => $satuan,
            ]);
        }
    }
}
