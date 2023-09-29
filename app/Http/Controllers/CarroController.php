<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     // Creo la variable carro para mostralo en la vista, la variable carroCompleto se encarga
     // de coger todos los artículos y se complementará con la variable total para mostrar
     // el precio total de todo el carro, además pongo la variable totalArticulo para
     // mostrar el precio con la suma de la cantidad de un único artículo
    public function index()
    {
        $carro = Carro::where('user_id', auth()->user()->id)
        ->paginate(3);
        $carroCompleto = Carro::where('user_id', auth()->user()->id)->get();
        $totalArticulo = [];
        $totalCarro = 0;
        foreach($carroCompleto as $item){
            $totalArticulo [$item->id] = $item->cantidad * $item->article->precio;
            $totalCarro = $item->cantidad * $item->article->precio + $totalCarro;
        }
        return view('carro.carro', compact('carro','totalCarro','totalArticulo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Carro $carro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carro $carro)
    {
        //
    }
    public function update(Request $request, Carro $carro)
    {
        // dd($carro->article->stock);
        $request->validate([
            'cantidad'=> ['numeric','min:1','max:'.$carro->article->stock]
        ]);
        $carro->update(['cantidad'=> $request->cantidad]);
        return redirect()->route('carro.index')->with('info','Cantidad editada');
    }
    public function destroy(Carro $carro)
    {
        $carro->delete();
        return redirect()->route('carro.index')->with('info','Artículo eliminado del carro');
    }
    // Esta función la utilizo para borrar todo el carro
    public function clear(){
        $listaCarro = Carro::where('user_id', auth()->user()->id)->get();
        foreach($listaCarro as $item){
            $item->delete();
        }
        return redirect()->route('articulos.show')->with('info','Carro borrado');
    }
    // Función que aumenta la cantidad de artículos en el carro
    public function subir(Carro $carro){
        $carro->update([
            'cantidad'=> $carro->cantidad + 1
        ]);
        return redirect()->route('carro.index')->with('info','Cantidad editada');
    }
    // Función que disminuye la cantidad de artículos en el carro
    public function bajar(Carro $carro){
        $carro->update([
            'cantidad'=> $carro->cantidad - 1
        ]);
        return redirect()->route('carro.index')->with('info','Cantidad editada');
    }
}
