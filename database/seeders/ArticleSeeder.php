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
            'imagen' => 'fotosamano/champupantene.png',
            'precio' => 20 ,
            'stock'=> 14,
            'marca_id'=> '1', //La id de Pantene es 1 (es una prueba creada manualmente)
            'category_id'=> '1',
        ]);
        Article::create([
            'nombre' => 'Champu Garnier',
            'descripcion' => 'es un champú de la marca Garnier para mujeres.',
            'disponible'=>'NO',
            'imagen' => 'fotosamano/champugarnier.jpeg',
            'precio' => 15 ,
            'stock'=> 0,
            'marca_id'=> '2', //La id de Garnier es 2 (es una prueba creada manualmente)
            'category_id'=> '2',
        ]);
        Article::create([
            'nombre' => 'Maquina de pelar',
            'descripcion' => 'es una máquina de pelar Philips para hombres.',
            'disponible'=>'SI',
            'imagen' => 'fotosamano/maquinaphilips.webp',
            'precio' => 25 ,
            'stock'=> 25,
            'marca_id'=> '3',
            'category_id'=> '1',
        ]);
        Article::create([
            'nombre' => 'Plancha de pelo',
            'descripcion' => 'es una plancha de pelo de la marca Regminton.',
            'disponible'=>'NO',
            'imagen' => 'fotosamano/plancharemington.webp',
            'precio' => 19.99 ,
            'stock'=> 10,
            'marca_id'=> '4',
            'category_id'=> '3',
        ]);
        Article::create([
            'nombre' => 'Acondicionador',
            'descripcion' => 'es un acondicionador para mujeres.',
            'disponible'=>'SI',
            'imagen' => 'fotosamano/acondicionadorloreal.jpg',
            'precio' => 30 ,
            'stock'=> 9,
            'marca_id'=> '5',
            'category_id'=> '2',
        ]);
        Article::create([
            'nombre' => 'Tinte',
            'descripcion' => 'es un producto para tintar el pelo para mujeres.',
            'disponible'=>'SI',
            'imagen' => 'fotosamano/tintegarnier.jpg',
            'precio' => 20 ,
            'stock'=> 40,
            'marca_id'=> '2',
            'category_id'=> '2',
        ]);
    }
}
