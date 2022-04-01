<?php

namespace Database\Seeders;

use App\Models\UserSalePoints;
use Illuminate\Database\Seeder;

class User_SalePointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSalePoints::create([
            'user_id' => 1,
            'salepoint_id' => 1
        ]);
    }
}
