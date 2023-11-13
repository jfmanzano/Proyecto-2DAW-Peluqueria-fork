<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Llamo a todos los seeders y al factory de User
        User::factory(9)->create();
        $this->call(UserSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);

        //Primero se borran las carpetas de imagenes (por si existieran de antes) y después las creo 
        Storage::deleteDirectory('imagenesmarcas');
        Storage::makeDirectory('imagenesmarcas');
        Storage::deleteDirectory('imagenesarticulos');
        Storage::makeDirectory('imagenesarticulos');
    }
}
