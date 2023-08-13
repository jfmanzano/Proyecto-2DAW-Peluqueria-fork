<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'nombre' => 'Champu Pantene',
            'descripcion' => 'es un champú de la marca Pantene para hombres.',
            'disponible'=>'SI',
            'imagen' => 'champupantene.png',
            'precio' => 20 ,
            'marca_id'=> '1', //La id de Pantene es 1 (es una prueba creada manualmente)
            'category_id'=> '1',
        ]);
        Article::create([
            'nombre' => 'Champu Garnier',
            'descripcion' => 'es un champú de la marca Garnier para mujeres.',
            'disponible'=>'NO',
            'imagen' => 'champugarnier.jpeg',
            'precio' => 15 ,
            'marca_id'=> '2', //La id de Garnier es 2 (es una prueba creada manualmente)
            'category_id'=> '2',
        ]);
    }
}
