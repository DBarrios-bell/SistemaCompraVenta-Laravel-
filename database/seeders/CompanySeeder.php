<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Sucursal 1',
            'address' => 'Calle 1',
            'phone' => '123456789',
            'taxpayer_id' => '900829-9',
        ]);
        Company::create([
        'name' => 'Sucursal 2',
        'address' => 'Calle 4',
        'phone' => '123456789',
        'taxpayer_id' => '900829-9',
        ]);
    }
}
