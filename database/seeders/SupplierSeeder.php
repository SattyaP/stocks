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
            ['name_supplier' => 'Supplier A', 'address' => '123 Main St', 'phone' => '123-456-7890'],
            ['name_supplier' => 'Supplier B', 'address' => '456 Elm St', 'phone' => '987-654-3210'],
            ['name_supplier' => 'Supplier C', 'address' => '789 Oak St', 'phone' => '555-555-5555'],
            ['name_supplier' => 'Supplier D', 'address' => '321 Pine St', 'phone' => '111-222-3333'],
            ['name_supplier' => 'Supplier E', 'address' => '654 Maple St', 'phone' => '444-555-6666'],
        ];

        foreach ($suppliers as $supplier) {
           Supplier::create($supplier);
        }
    }
}
