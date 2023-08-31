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
     * Aquí creos ejemplos de artículos
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
        Article::create([
            'nombre' => 'Maquina de pelar',
            'descripcion' => 'es una máquina de pelar Philips para hombres.',
            'disponible'=>'SI',
            'imagen' => 'maquinaphilips.webp',
            'precio' => 25 ,
            'marca_id'=> '3',
            'category_id'=> '1',
        ]);
        Article::create([
            'nombre' => 'Plancha de pelo',
            'descripcion' => 'es una plancha de pelo de la marca Regminton.',
            'disponible'=>'NO',
            'imagen' => 'plancharemington.webp',
            'precio' => 19.99 ,
            'marca_id'=> '4',
            'category_id'=> '3',
        ]);
        Article::create([
            'nombre' => 'Acondicionador',
            'descripcion' => 'es un acondicionador para mujeres.',
            'disponible'=>'SI',
            'imagen' => 'acondicionadorloreal.jpg',
            'precio' => 30 ,
            'marca_id'=> '5',
            'category_id'=> '2',
        ]);
        Article::create([
            'nombre' => 'Tinte',
            'descripcion' => 'es un producto para tintar el pelo para mujeres.',
            'disponible'=>'SI',
            'imagen' => 'tintegarnier.jpg',
            'precio' => 20 ,
            'marca_id'=> '2',
            'category_id'=> '2',
        ]);
    }
}
