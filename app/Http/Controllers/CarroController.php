<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carro = Carro::where('user_id', auth()->user()->id)
        ->paginate(3);
        return view('carro.carro', compact('carro'));
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carro $carro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carro $carro)
    {
        //
    }
}
