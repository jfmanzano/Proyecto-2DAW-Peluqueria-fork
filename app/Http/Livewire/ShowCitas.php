<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;
use Livewire\WithPagination;
//Librería que utilizo para sacar fecha actual del sistema
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowCitas extends Component
{
    use WithPagination;
    use AuthorizesRequests; //Esto es necesario para las políticas

    public string $buscar = "", $campo = "fecha", $orden = "desc";
    public bool $openEditar = false;
    public Cita $miCita;

    // Variable que recibe los mensajes de la vista
    protected $listeners = [
        'refreshCitas' => 'render',
        'borrarCita' => 'borrar'
    ];
    public function render()
    {
        // En el render compruebo que si el usuario es admin puede ver las citas de todos los usuarios
        // y si no es admin solo puede ver las suyas
        if (auth()->user()->is_admin) {
            $citas = Cita::where('fecha', 'like', "%{$this->buscar}%")
                ->orderBy($this->campo, $this->orden)
                ->paginate(2);
        } else {
            $citas = Cita::where('fecha', 'like', "%{$this->buscar}%")
                ->where('user_id', auth()->user()->id)
                ->orderBy($this->campo, $this->orden)
                ->paginate(2);
        }
        // Aquí recojo la fecha actual para el editar con la librería Carbon
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('d/m/Y H:i');
        return view('livewire.show-citas', compact('citas', 'fechaActual'));
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

    public function borrar(Cita $cita)
    {
        //Llamamos al método delete de CitaPolicy y le pasamos la cita
        $this->authorize('delete', $cita);
        //Borramos el registro de la base de datos
        $cita->delete();
        //Emitimos un mensaje y retornamos a la página de categorías
        return redirect('/citas')->with('info', 'Cita borrada con éxito');
    }

    // Función para preguntar primero si se quiere borrar la cita
    public function confirmar(Cita $cita)
    {
        $this->emit('permisoBorrar4', $cita->id);
    }

    // Función para abrir la ventana modal del editar
    public function editar(Cita $miCita)
    {
        //Llamamos al método update de CitaPolicy y le pasamos la cita
        $this->authorize('update', $miCita);
        $this->miCita = $miCita;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
        // Validaciones
        //Aquí meto la variable fechaActual para que compruebe que no se editen citas 
        // con fecha anterior al día de hoy
        $fechaActual = Carbon::now()->tz('Europe/Madrid');
        $fechaActual = $fechaActual->format('d/m/Y H:i');
        return [
            'miCita.fecha' => [
                'required', 'date_format:d/m/Y H:i', 'after_or_equal:' . $fechaActual, 
                'regex:~^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4} (0[9]|1[0-9]|2[0-1]):[0-5][0-9]$~',
                'unique:citas,fecha,'. $this->miCita->id,
            ],
            'miCita.tipo' => ['required', 'in:Pelado,Lavado,Tinte,Peinado'],
        ];
    }

    public function update()
    {
        $this->validate();
        $this->miCita->update([
            'fecha'=>$this->miCita->fecha,
            'tipo'=>$this->miCita->tipo,
        ]);
        $this->miCita = new Cita;
        $this->emit('mensaje', 'Cita Actualizada');
        $this->reset(['openEditar']);
    }
}
