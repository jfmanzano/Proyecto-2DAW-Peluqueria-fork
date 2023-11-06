<?php

namespace App\Http\Livewire;

use App\Models\Carro;
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

    public string $buscar = "", $campo = "nombre", $orden = "desc";
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
        // Consulta para administrador
        if (auth()->user()->is_admin) {
            $articulos = Article::where('nombre', 'like', "%{$this->buscar}%")
                ->orderBy($this->campo, $this->orden)
                ->paginate(3);
        } else {
            // Consulta para usuario normal
            $articulos = Article::where('nombre', 'like', "%{$this->buscar}%")
                ->where('disponible', 'SI')
                ->orderBy($this->campo, $this->orden)
                ->paginate(3);
        }
        // Esta variable comprueba los artículos que tenga en el carro el usuario logueado
        $arrayCarro = Carro::where('user_id', auth()->user()->id)->pluck('article_id')->toArray();
        // En el render uso la función buscar para los artículos
        // y creo los arrays categorias y marcas para la ventana modal editar 
        $categories = Category::all()->pluck('nombre', 'id')->toArray();
        $categories[0] = '______ Elige una categoría _____';
        ksort($categories);
        $marcas = Marca::all()->pluck('nombre', 'id')->toArray();
        $marcas[0] = '______ Elige una marca _____';
        ksort($marcas);
        return view('livewire.show-articles', compact('articulos', 'categories', 'marcas', 'arrayCarro'));
    }

    //Función para ordenar el contenido de la tabla
    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function borrar(Article $articulo)
    {
        //Borramos la imagen
        Storage::delete($articulo->imagen);
        //Borramos el registro de la base de datos
        $articulo->delete();
        //Emitimos un mensaje y retornamos a la página de categorías
        return redirect('/articles')->with('info', 'Artículo borrado con éxito');
    }

    // Función para preguntar primero si se quiere borrar el artículo
    public function confirmar(Article $articulo)
    {
        $this->emit('permisoBorrar3', $articulo->id);
    }

    // Función para abrir la ventana modal del detalle
    public function detalle(Article $articulo)
    {
        $this->articulo = $articulo;
        $this->openDetalle = true;
    }

    // Función para abrir la ventana modal del editar
    public function editar(Article $miArticulo)
    {
        $this->miArticulo = $miArticulo;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
        // Validaciones
        return [
            'miArticulo.nombre' => '',
            'miArticulo.descripcion' => ['required', 'string', 'min:10'],
            'miArticulo.disponible' => ['required', 'in:SI,NO'],
            'miArticulo.precio' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'miArticulo.stock' => ['required', 'numeric', 'min:0', 'max:10000'],
            'miArticulo.imagen' => ['required', 'image', 'max:2048'],
            'miArticulo.category_id' => ['required', 'exists:categories,id'],
            'miArticulo.marca_id' => ['required', 'exists:marcas,id'],
            'imagen' => ['nullable', 'image', 'max:2048']
        ];
    }

    public function update()
    {
        $this->validate([
            'miArticulo.nombre' => ['required', 'string', 'min:3', 'max:255', 'unique:articles,nombre,'
                . $this->miArticulo->id]
        ]);
        // Si se ha metido una imagen nueva se borra la antigua y guardamos la nueva
        if ($this->imagen) {
            Storage::delete($this->miArticulo->imagen);
            $this->miArticulo->imagen = $this->imagen->store('imagenesarticulos');
        }

        $this->miArticulo->update([
            'nombre' => $this->miArticulo->nombre,
            'descripcion' => $this->miArticulo->descripcion,
            'disponible' => $this->miArticulo->disponible,
            'precio' => $this->miArticulo->precio,
            'stock' => $this->miArticulo->stock,
            'imagen' => $this->miArticulo->imagen,
            'category_id' => $this->miArticulo->category_id,
            'marca_id' => $this->miArticulo->marca_id,
        ]);
        $this->miArticulo = new Article;
        $this->emit('mensaje', 'Artículo Actualizado');
        $this->reset(['openEditar', 'imagen']);
    }

    // Función que permite cambiar la disponibilidad de un artículo si se pincha en la vista
    // el cuadro que corresponda a cada artículo
    public function cambiarDisponibilidad(Article $article)
    {
        $disponibilidad = ($article->disponible == "SI") ? "NO" : "SI";
        $article->update([
            'disponible' => $disponibilidad,
        ]);
        $this->emit("mensaje", "Se cambió la disponibilidad del artículo");
    }

    // Esta función añade al carro el artículo seleccionado
    public function ponerEnCarro($id)
    {
        // Si la función comprobarCarro devuelve false volverá a la página de artículos
        // informando de que no hay stock de ese artículo
        if (!self::comprobarCarro($id)) {
            return redirect()->route('articulos.show')->with('info', 'No hay artículos disponibles');
        }
        self::quitarStock(Article::where('id',$id)->first());
        Carro::create([
            'user_id' => auth()->user()->id,
            'article_id' => $id,
            'cantidad' => 1
        ]);
        return redirect('/articles')->with('info', 'Artículo añadido al carro');
    }

    // Esta función elimina del carro el artículo seleccionado
    public function eliminarArticuloCarro($id)
    {
        $carro = Carro::where('article_id', $id)->first();
        self::anadirStock(Article::where('id',$id)->first(), $carro);
        $carro->delete();
        return redirect('/articles')->with('info', 'Artículo eliminado del carro');
    }

    // Esta función comprueba primero si el artículo tiene stock, si es 0 devuelve false. 
    // Luego comprueba si está en el carro o no, si no está en el carro comprueba 
    // si el artículo está disponible para añadirse al carro, si no está disponible
    // devuelve false para que en la función ponerEnELCarro muestre error
    private function comprobarCarro($id)
    {
        $articulo = Article::where('id', $id)->first();
        $arrayCarro = Carro::where('user_id', auth()->user()->id)->pluck('article_id')->toArray();
        if ($articulo->stock == 0) {
            return false;
            //
        }
        if (!in_array($id, $arrayCarro)) {
            if ($articulo->disponible == "SI") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Función que aumenta el stock del artículo (Modelo Article)
    public function anadirStock($articulo, $articuloCarro)
    {
        $articulo->update([
            'stock' => $articulo->stock + $articuloCarro->cantidad
        ]);
    }

    // Función que quita el stock del artículo (Modelo Article)
    public function quitarStock($articulo)
    {
        $articulo->update([
            'stock' => $articulo->stock -1
        ]);
    }
}
