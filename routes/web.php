<?php

use App\Http\Livewire\ShowArticles;
use App\Http\Livewire\ShowCategories;
use App\Http\Livewire\ShowMarcas;
use App\Models\Marca;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $marcas = Marca::orderBy('id', 'desc')
    ->paginate(2);
    return view('dashboard', compact('marcas'));
    })->name('dashboard');
    Route::get('/categories', ShowCategories::class)->name('categorias.show');
    Route::get('/marcas', ShowMarcas::class)->name('marcas.show');
    Route::get('/articles', ShowArticles::class)->name('articulos.show');
});
