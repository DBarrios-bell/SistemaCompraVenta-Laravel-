<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'LARAVEL Y LIVEWIRE',
            'cost' => 200,
            'price' => 350,
            'barcode' => '12324532',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'curso.pnp'
        ]);
        Product::create([
            'name' => 'RUNNING',
            'cost' => 200,
            'price' => 350,
            'barcode' => '1223432',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'tenis.pnp'
        ]);
        Product::create([
            'name' => 'IPHONE 11',
            'cost' => 200,
            'price' => 350,
            'barcode' => '123987',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 3,
            'image' => 'iphone11.pnp'
        ]);
        Product::create([
            'name' => 'LARAVEL Y LIVEWIRE',
            'cost' => 200,
            'price' => 350,
            'barcode' => '1324532',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 1,
            'image' => 'curso.pnp'
        ]);
        Product::create([
            'name' => 'PC GAMER',
            'cost' => 200,
            'price' => 350,
            'barcode' => '122432',
            'stock' => 1000,
            'alerts' => 10,
            'category_id' => 2,
            'image' => 'pc.pnp'
        ]);
    }
}
