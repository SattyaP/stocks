<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'nama_supplier' => 'PT. Supplier 1',
                'alamat' => 'Jl. Supplier 1 No. 1',
                'telepon' => '081234567890',
                'email' => 'supplier1@example.com'
            ],
            [
                'nama_supplier' => 'PT. Supplier 2',
                'alamat' => 'Jl. Supplier 2 No. 2',
                'telepon' => '081234567891',
                'email' => 'supplier2@example.com'
            ],
            [
                'nama_supplier' => 'PT. Supplier 3',
                'alamat' => 'Jl. Supplier 3 No. 3',
                'telepon' => '081234567892',
                'email' => 'supplier3@example.com'
            ],
            [
                'nama_supplier' => 'PT. Supplier 4',
                'alamat' => 'Jl. Supplier 4 No. 4',
                'telepon' => '081234567893',
                'email' => 'supplier4@example.com'
            ],
            [
                'nama_supplier' => 'PT. Supplier 5',
                'alamat' => 'Jl. Supplier 5 No. 5',
                'telepon' => '081234567894',
                'email' => 'supplier5@example.com'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
