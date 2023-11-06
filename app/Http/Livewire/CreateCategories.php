<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCategories extends Component
{
    use WithPagination;
    public bool $openCrear = false;
    public string $nombre ="", $color = "";

    protected function rules(): array
    {
        // Validaciones
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255', 'unique:categories,nombre'],
            'color' => ['required','regex:/#[A-Fa-f0-9]{6}/']
        ];
    }

    public function render()
    {
        return view('livewire.create-categories');
    }

    // Función para abrir la ventana modal
    public function openCrear(){
        $this->openCrear = true;
    }

    public function guardar(){
        $this->validate();
        //Guardamos la categoría
        Category::create([
            "nombre"=>$this->nombre,
            "color"=>$this->color
        ]);

        $this->reset(["openCrear","nombre","color"]);
        $this->emitTo("show-categories","refreshCategories");
        $this->emit("mensaje", "Categoría Creada");
    }

    // Función para cerrar la ventana modal si se pulsa el botón cancelar
    public function cerrar(){
        $this->reset(["openCrear","nombre","color"]);
    }
}
