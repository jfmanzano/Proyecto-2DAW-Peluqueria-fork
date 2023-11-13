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

    public bool $openEditar = false;
    public Cita $miCita;

    // Variable que recibe los mensajes de la vista
    protected $listeners = [
        'borrarCita' => 'borrar'
    ];
    public function render()
    {
        // En el render compruebo que si el usuario es admin puede ver las citas de todos los usuarios
        // y si no es admin solo puede ver las suyas.
        // Al insertar el Datatable no hace falta ninguna barra de búsqueda
        // ya que la lleva implementada, ni necesita paginate
        if (auth()->user()->is_admin) {
            $citas = Cita::get();
        } else {
            $citas = Cita::where('user_id', auth()->user()->id)->get();
        }
        // Aquí recojo la fecha actual para el editar con la librería Carbon
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('Y-m-dTh:i');
        return view('livewire.show-citas', compact('citas', 'fechaActual'));
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
        $fechaActual = $fechaActual->format('Y-m-dTh:i');
        // Aquí me creo una variable para borrar las letras de la fecha actual ya que va con CEST
        // por el timezone(tz). La T no la borro porque la necesito para la validación del datetime-local
        // ya que va con una T como separador
        $letras = ["C","E","S"];
        $fechaActual = str_replace($letras,"",$fechaActual);
        return [
            'miCita.fecha' => [
                'required', 'after_or_equal:' . $fechaActual, 
                'regex:/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])T(0[9]|1\d|2[01]):[0-5]\d$/',
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
        return redirect()->route("citas.show")->with("info", "Cita Actualizada");
    }
    // Función para cerrar la ventana modal si se pulsa el botón cancelar
    public function cerrar(){
        return redirect()->route("citas.show");
    }
}
