<?php

use App\Http\Controllers\CarroController;
use App\Models\Marca;
use App\Http\Livewire\ShowCitas;
use App\Http\Livewire\ShowMarcas;
use App\Http\Livewire\ShowArticles;
use App\Http\Livewire\ShowCategories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

//En este middleware entrará cualquier usuario autenticado
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $articles = Article::where('disponible','SI')
        ->orderBy('id', 'desc')
    ->paginate(3);
    return view('dashboard', compact('articles'));
    })->name('dashboard');
    Route::get('/articles', ShowArticles::class)->name('articulos.show');
    Route::get('/citas', ShowCitas::class)->name('citas.show');
    Route::resource('carro', CarroController::class);
});

//En este middleware entrará cualquier usuario autenticado y que sea administrador
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is_admin'
])->group(function () {
    Route::get('/categories', ShowCategories::class)->name('categorias.show');
    Route::get('/marcas', ShowMarcas::class)->name('marcas.show');
});

//Rutas para formulario de contacto
Route::get('contacto',[MailController::class, 'pintarFormulario'])->name('contacto.pintar');
Route::post('contacto',[MailController::class, 'procesarFormulario'])->name('contacto.procesar');

//Rutas para login con redes sociales
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    //Creamos una variable para comprobar si existe el usuario
    $userExists = User::where('external_id', $user->id)
    ->where('external_auth', 'google')
    ->first();

    //Si el usuario ya existe le hacemos login, si no, lo creamos cogiendo los campos que da Google
    if($userExists){
        Auth::login($userExists);
    } else {
        $newUser = User::create([
            'name'=> $user->name,
            'email'=> $user->email,
            'avatar'=> $user->avatar,
            'external_id'=> $user->id,
            'external_auth'=> 'google',
        ]);
        //Al crearlo hacemos login
        Auth::login($newUser);
    }
    // $user->token

    return redirect('/dashboard');
});