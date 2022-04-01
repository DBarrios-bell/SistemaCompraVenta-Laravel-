<?php

namespace Database\Seeders;

use App\Models\SalePoints;
use Illuminate\Database\Seeder;

class SalePointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalePoints::create([
            'name' => 'Sucursal 1',
            'adress' => 'Calle #1',
            'company_id' => 1
        ]);
    }
}
