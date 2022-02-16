<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Demo',
            'phone' => '3162361818',
            'email' => 'demo@gmail.com',
            'profile' => 'Administrador',
            'status' => 'ACTIVE',
            'password' => bcrypt('123Admin2022')
        ]);
    }
}
