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
    protected $listeners = [
        "refreshCategories"=>"render",
        'borrarCategory'=>'borrar'
    ];

    public function render()
    {
        $categorias = Category::where('nombre', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(2);
        return view('livewire.show-categories', compact('categorias'));
    }

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
        //Emitimos un mensaje
        $this->emit('mensaje', 'Categoría borrada con éxito');
        return redirect('/categories');
    }

    public function confirmar(Category $category){
        $this->emit('permisoBorrar', $category->id);
    }

    public function editar(Category $miCategory){
        $this->miCategory = $miCategory;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
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
