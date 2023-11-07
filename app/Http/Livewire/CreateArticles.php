<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class CreateArticles extends Component
{
    use WithPagination;
    use WithFileUploads;
    public bool $openCrear = false;
    public string $nombre = "", $descripcion = "", $disponible = "";
    public $imagen, $precio, $stock, $category_id, $marca_id;

    public function render()
    {
        // En el render creo un array de categorías y de marcas para que aparezca en el formulario
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
        // Validaciones
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:255', 'unique:articles,nombre'],
            'descripcion' => ['required','string', 'min:10'],
            'disponible' => ['required', 'in:SI,NO'],
            'precio' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'stock' => ['required', 'numeric', 'min:0', 'max:10000'],
            'imagen' => ['required','image', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'marca_id' => ['required', 'exists:marcas,id']
        ];
    }

    // Función para abrir la ventana modal
    public function openCrear(){
        $this->openCrear = true;
    }

    public function guardar(){
        $this->validate();
        // Guardamos la imagen
        $imagen = $this->imagen->store('imagenesarticulos');
        // Guardamos el artículo
        Article::create([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'disponible'=>$this->disponible,
            'precio'=>$this->precio,
            'stock'=>$this->stock,
            'imagen'=>$imagen,
            'category_id'=>$this->category_id,
            'marca_id'=>$this->marca_id
        ]);
        // Cuando creo un artículo me aparece una carpeta temporal que no se borra,
        // utilizo esta línea para borrarlo
        File::deleteDirectory(storage_path('app/public/livewire-tmp'));

        $this->reset(["openCrear","nombre","descripcion","disponible","precio","stock",
        "imagen","category_id","marca_id"]);
        $this->emitTo("show-articles","refreshArticulos");
        $this->emit("mensaje", "Artículo Creado");
    }

    // Función para cerrar la ventana modal si se pulsa el botón cancelar
    public function cerrar(){
        $this->reset(["openCrear","nombre","descripcion","disponible","precio","stock",
        "imagen","category_id","marca_id"]);
    }
}
