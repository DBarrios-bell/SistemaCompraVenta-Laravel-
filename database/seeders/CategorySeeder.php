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
            'name' =>'CURSOS',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
        Category::create([
            'name'=>'TENIS',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
        Category::create([
            'name' =>'CELULARES',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
        Category::create([
            'name' => 'COMPUTADORAS',
            'image' => 'https://dummyimage.com/200x150/c97bc9/fff'
        ]);
    }
}
