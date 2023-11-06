<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ShowMarcas extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $buscar = "", $campo="nombre", $orden="desc";
    public Marca $miMarca;
    public bool $openEditar = false;
    public $imagen;

    // Variable que recibe los mensajes de la vista
    protected $listeners = [
        "refreshMarcas"=>"render",
        'borrarMarca'=>'borrar'
    ];

    public function render()
    {
        // En el render uso la función buscar para las marcas
        $marcas = Marca::where('nombre', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(2);
        return view('livewire.show-marcas', compact('marcas'));
    }

    //Función para ordenar el contenido de la tabla
    public function ordenar(string $campo){
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function borrar(Marca $marca){
        //Borramos la imagen
        Storage::delete($marca->imagen);
        //Borramos el registro de la base de datos
        $marca->delete();
        //Emitimos un mensaje y retornamos a la página de marcas
        return redirect('/marcas')->with('info', 'Marca borrada con éxito');
    }

    // Función para preguntar primero si se quiere borrar la categoría
    public function confirmar(Marca $marca){
        $this->emit('permisoBorrar2', $marca->id);
    }

    // Función para abrir la ventana modal del editar
    public function editar(Marca $miMarca){
        $this->miMarca = $miMarca;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
        // Validaciones
        return [
            'miMarca.nombre' => '',
            'miMarca.descripcion' => ['required','string','min:10'],
            'imagen' => ['nullable', 'image', 'max:2048']
        ];
    }

    public function update(){
        $this->validate([
            'miMarca.nombre'=>['required', 'string', 'min:3', 'max:255', 'unique:marcas,nombre,'.$this->miMarca->id]
        ]);
        if($this->imagen){
            Storage::delete($this->miMarca->imagen);
            $this->miMarca->imagen = $this->imagen->store('imagenesmarcas');
        }
        $this->miMarca->update([
            'nombre'=>$this->miMarca->nombre,
            'descripcion'=>$this->miMarca->descripcion,
            'imagen'=>$this->miMarca->imagen
        ]);
        $this->miMarca = new Marca;
        $this->emit('mensaje', 'Marca Actualizada');
        $this->reset(['openEditar', 'imagen']);
    }

}
