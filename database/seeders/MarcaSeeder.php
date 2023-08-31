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
            'descripcion' => 'Es una marca registrada de productos para cuidado del cabello, 
            producido por Procter & Gamble.',
            'imagen' => 'pantene.jpg'
        ]);

        Marca::create([
            'nombre' => 'Garnier',
            'descripcion' => "Es una marca de cosméticos de mercado masivo de la compañía 
            francesa de cosméticos LOréal. Produce productos para el cuidado del cabello y la piel.",
            'imagen' => 'garnier.jpg'
        ]);

        Marca::create([
            'nombre' => 'Philips',
            'descripcion' => " Es una empresa neerlandesa de tecnología fundada en la ciudad de Eindhoven 
            en 1891. Es considerada una de las más grandes e importantes del mundo en su campo. 
            Está dedicada, principalmente, a los sectores de la electrónica y la asistencia sanitaria.",
            'imagen' => 'philips.jpg'
        ]);

        Marca::create([
            'nombre' => 'Remington',
            'descripcion' => "Es una marca estadounidense de cuidado personal que fabrica cortapelos, 
            afeitadoras eléctricas, depiladoras y productos para el cuidado del cabello. 
            Es una subsidiaria de Spectrum Brands y Oak Hill Capital.",
            'imagen' => 'regminton.jpg'
        ]);

        Marca::create([
            'nombre' => "L´Oreal",
            'descripcion' => "L´Oréal es una empresa francesa de cosméticos y belleza, creada en 1909 
            por el químico Eugène Schueller. Con sede en Clichy, es la compañía de cosméticos 
            más grande del mundo, y cuenta con una sede social en París.",
            'imagen' => 'loreal.jpg'
        ]);
    }
}
