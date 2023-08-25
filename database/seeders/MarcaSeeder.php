<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Aquí creamos ejemplos de marcas
     */
    public function run(): void
    {
        Marca::create([
            'nombre' => 'Pantene',
            'descripcion' => 'es una marca registrada de productos para cuidado del cabello, 
            producido por Procter & Gamble.',
            'imagen' => 'pantene.jpg'
        ]);

        Marca::create([
            'nombre' => 'Garnier',
            'descripcion' => "es una marca de cosméticos de mercado masivo de la compañía 
            francesa de cosméticos LOréal. Produce productos para el cuidado del cabello y la piel.",
            'imagen' => 'garnier.jpg'
        ]);
    }
}
