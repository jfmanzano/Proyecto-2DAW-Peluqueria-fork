<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowArticles extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $buscar = "", $campo="nombre", $orden="desc";
    public bool $openDetalle = false, $openEditar = false;
    public Article $articulo, $miArticulo;
    public $imagen;

    // Variable que recibe los mensajes de la vista
    protected $listeners = [
        'refreshArticulos' => 'render',
        'borrarArticulo' => 'borrar'
    ];

    public function render()
    {
        // En el render uso la función buscar para los artículos
        // y creo los arrays categorias y marcas para la ventana modal editar
        $articulos = Article::where('nombre', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(2);
        $categories = Category::all()->pluck('nombre', 'id')->toArray();
        $categories[0]='______ Elige una categoría _____';
        ksort($categories);
        $marcas = Marca::all()->pluck('nombre', 'id')->toArray();
        $marcas[0]='______ Elige una marca _____';
        ksort($marcas);
        return view('livewire.show-articles', compact('articulos','categories','marcas'));
    }

    //Función para ordenar el contenido de la tabla
    public function ordenar(string $campo){
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function borrar(Article $articulo){
        //Borramos la imagen
        Storage::delete($articulo->imagen);
        //Borramos el registro de la base de datos
        $articulo->delete();
        //Emitimos un mensaje
        $this->emit('mensaje', 'Artículo borrado con éxito');
        return redirect('/articles');
    }

    // Función para preguntar primero si se quiere borrar el artículo
    public function confirmar(Article $articulo){
        $this->emit('permisoBorrar3', $articulo->id);
    }

    // Función para abrir la ventana modal del detalle
    public function detalle (Article $articulo){
        $this->articulo = $articulo;
        $this->openDetalle = true;
    }

    // Función para abrir la ventana modal del editar
    public function editar(Article $miArticulo){
        $this->miArticulo = $miArticulo;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
        // Validaciones
        return [
            'miArticulo.nombre' => '',
            'miArticulo.descripcion' => ['required','string','min:10'],
            'miArticulo.disponible' => ['required', 'in:SI,NO'],
            'miArticulo.precio' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'miArticulo.stock' => ['required', 'numeric', 'min:0', 'max:10000'],
            'miArticulo.imagen' => ['required','image', 'max:2048'],
            'miArticulo.category_id' => ['required', 'exists:categories,id'],
            'miArticulo.marca_id' => ['required', 'exists:marcas,id'],
            'imagen' => ['nullable', 'image', 'max:2048']
        ];
    }

    public function update(){
        $this->validate([
            'miArticulo.nombre'=>['required', 'string', 'min:3', 'unique:articles,nombre,'
            .$this->miArticulo->id]
        ]);
        if($this->imagen){
            Storage::delete($this->miArticulo->imagen);
            $this->miArticulo->imagen = $this->imagen->store('imagenesarticulos');
        }
        if($this->miArticulo->stock == 0){
            $this->miArticulo->disponible = "NO";
        }
        $this->miArticulo->save();
        $this->emit('mensaje', 'Artículo Actualizado');
        $this->reset(['openEditar', 'imagen']);
    }

    // Función que permite cambiar la disponibilidad de un artículo si se pincha en la vista
    // el cuadro que corresponda a cada artículo
    public function cambiarDisponibilidad(Article $article){
        $disponibilidad=($article->disponible=="SI") ? "NO" : "SI";
        $article->update([
            'disponible'=>$disponibilidad,
        ]);
        $this->emit("mensaje", "Se cambió la disponibilidad del artículo");
    }
}
