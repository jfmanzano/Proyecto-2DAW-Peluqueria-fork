<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategories extends Component
{
    use WithPagination;

    public string $buscar = "", $campo="nombre", $orden="desc";
    public Category $miCategory;
    public bool $openEditar = false;

    //Variable que recibe los mensajes de la vista
    protected $listeners = [
        "refreshCategories"=>"render",
        'borrarCategory'=>'borrar'
    ];

    public function render()
    {
        // En el render uso la función buscar para las categorías
        $categorias = Category::where('nombre', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(2);
        return view('livewire.show-categories', compact('categorias'));
    }

    //Función para ordenar el contenido de la tabla
    public function ordenar(string $campo){
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function borrar(Category $category){
        //Borramos el registro de la base de datos
        $category->delete();
        //Emitimos un mensaje y retornamos a la página de categorías
        return redirect('/categories')->with('info', 'Categoría borrada con éxito');
    }

    // Función para preguntar primero si se quiere borrar la categoría
    public function confirmar(Category $category){
        $this->emit('permisoBorrar', $category->id);
    }

    // Función para abrir la ventana modal del editar
    public function editar(Category $miCategory){
        $this->miCategory = $miCategory;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
        // Validaciones
        return [
            'miCategory.nombre' => ['required', 'string', 'min:3', 'unique:categories,nombre,'.$this->miCategory->id],
            'miCategory.color' => ['nullable','regex:/#[A-Fa-f0-9]{6}/']
        ];
    }

    public function update(){
        $this->validate();
        //Actualizamos el registro
        $this->miCategory->update([
            'nombre'=>$this->miCategory->nombre,
            'color'=>$this->miCategory->color,
        ]);
        $this->miCategory = new Category;
        $this->reset('openEditar');
        $this->emit('mensaje', 'Categoría editada con éxito');
    }
}
