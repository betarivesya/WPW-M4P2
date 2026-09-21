<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'PT. Indofood Sukses Makmur Tbk',
                'phone' => '02157958822',
                'address' => 'Sudirman Plaza, Indofood Tower, Jl. Jend. Sudirman Plaza Kav. 76-78, Jakarta Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT. Unilever Indonesia Tbk',
                'phone' => '02180827000',
                'address' => 'Grha Unilever, Green Office Park Kav. 3, Jl. BSD Boulevard Barat, Tangerang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT. Mayora Indah Tbk',
                'phone' => '02180637000',
                'address' => 'Gedung Mayora, Jl. Tomang Raya No. 21-23, Jakarta Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
