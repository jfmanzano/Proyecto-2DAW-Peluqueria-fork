<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Hombre' => '#58aef6',
            'Mujer' => '#f93aa8',
            'Unisex' => '#5af93a',
        ];
        foreach($categorias as $k=>$v){
            Category::create([
                'nombre'=>$k,
                'color'=>$v
            ]);
        }
    }
}
