<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'salepoint_id' => 1,
            'name' =>'CURSOS',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
        Category::create([
            'salepoint_id' => 1,
            'name'=>'TENIS',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
        Category::create([
            'salepoint_id' => 1,
            'name' =>'CELULARES',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
        Category::create([
            'salepoint_id' => 1,
            'name' => 'COMPUTADORAS',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
    }
}
