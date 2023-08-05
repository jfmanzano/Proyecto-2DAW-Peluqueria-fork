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
        return [
            'nombre' => ['required', 'string', 'min:3', 'unique:categories,nombre'],
            'color' => ['required','regex:/#[A-Fa-f0-9]{6}/']
        ];
    }

    public function render()
    {
        return view('livewire.create-categories');
    }

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

    public function cerrar(){
        $this->reset(["openCrear","nombre","color"]);
    }
}
