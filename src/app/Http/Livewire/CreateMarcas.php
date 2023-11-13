<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateMarcas extends Component
{
    use WithPagination;
    use WithFileUploads;
    public bool $openCrear = false;
    public string $nombre ="", $descripcion = "";
    public $imagen;

    protected function rules(): array
    {
        // Validaciones
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255', 'unique:marcas,nombre'],
            'descripcion' => ['required','string', 'min:10'],
            'imagen' => ['required','image', 'max:2048']
        ];
    }

    public function render()
    {
        return view('livewire.create-marcas');
    }

    // Función para abrir la ventana modal
    public function openCrear(){
        $this->openCrear = true;
    }

    public function guardar(){
        $this->validate();
        //Guardamos la imagen
        $imagen = $this->imagen->store('imagenesmarcas');
        //Guardamos la marca
        Marca::create([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'imagen'=>$imagen
        ]);

        $this->reset(["openCrear","nombre","descripcion","imagen"]);
        $this->emitTo("show-marcas","refreshMarcas");
        $this->emit("mensaje", "Marca Creada");
    }

    // Función para cerrar la ventana modal si se pulsa el botón cancelar
    public function cerrar(){
        $this->reset(["openCrear","nombre","descripcion","imagen"]);
    }
}
