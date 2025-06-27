<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
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

        foreach ($units as $unit) {
            Unit::create([
                'unit_name' => $unit,
            ]);
        }
    }
}
