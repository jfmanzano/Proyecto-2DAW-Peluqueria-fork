<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CreateArticles extends Component
{
    use WithPagination;
    use WithFileUploads;
    public bool $openCrear = false;
    public string $nombre = "", $descripcion = "", $disponible = "";
    public $imagen, $precio, $category_id, $marca_id;

    public function render()
    {
        $categories = Category::all()->pluck('nombre', 'id')->toArray();
        $categories[0]='______ Elige una categoría _____';
        ksort($categories);
        $marcas = Marca::all()->pluck('nombre', 'id')->toArray();
        $marcas[0]='______ Elige una marca _____';
        ksort($marcas);
        return view('livewire.create-articles', compact('categories','marcas'));
    }

    protected function rules(): array
    {
        
        return [
            'nombre' => ['required', 'string', 'min:3', 'unique:categories,nombre'],
            'descripcion' => ['required','string', 'min:10'],
            'disponible' => ['required', 'in:SI,NO'],
            'precio' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'imagen' => ['required','image', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'marca_id' => ['required', 'exists:marcas,id']
        ];
    }

    public function openCrear(){
        $this->openCrear = true;
    }

    public function guardar(){
        $this->validate();
        //Guardamos la imagen
        $imagen = $this->imagen->store('imagenesarticulos');
        //Guardamos la marca
        Article::create([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'disponible'=>$this->disponible,
            'precio'=>$this->precio,
            'imagen'=>$imagen,
            'category_id'=>$this->category_id,
            'marca_id'=>$this->marca_id
        ]);

        $this->reset(["openCrear","nombre","descripcion","disponible","precio","imagen","category_id","marca_id"]);
        $this->emitTo("show-articles","refreshArticulos");
        $this->emit("mensaje", "Artículo Creado");
    }

    public function cerrar(){
        $this->reset(["openCrear","nombre","descripcion","disponible","precio","imagen","category_id","marca_id"]);
    }
}
