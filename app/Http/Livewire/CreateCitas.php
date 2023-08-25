<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Cita;
use Livewire\Component;
use Illuminate\Validation\Validator;

class CreateCitas extends Component
{

    public $fecha="", $tipo="";
    public bool $openCrear = false;

    public function render()
    {
        // En el render creo una variable que contenga la fecha actual usando la librería Carbon
        // y le doy el formato
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('d/m/Y H:i');
        return view('livewire.create-citas',compact('fechaActual'));
    }

    protected function rules(): array
    {
        // Validaciones
        //Aquí meto la variable fechaActual para que compruebe que no se creen citas antes del día de hoy
        $fechaActual = Carbon::now()->tz('Europe/Madrid');
        $fechaActual = $fechaActual->format('d/m/Y H:i');
        return [
            'fecha' => ['required', 'date_format:d/m/Y H:i', 'after_or_equal:'.$fechaActual,  
            'regex:~^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4} (0[9]|1[0-9]|2[0-1]):[0-5][0-9]$~',
            'unique:citas,fecha'],
            'tipo' => ['required', 'in:Pelado,Lavado,Tinte,Peinado'],
        ];
    }

    // Función para abrir la ventana modal
    public function openCrear(){
        $this->openCrear = true;
    }

    public function guardar(){
        $this->validate();
        //Guardamos la cita
        Cita::create([
            'fecha'=>$this->fecha,
            'tipo'=>$this->tipo,
            'user_id'=>auth()->user()->id
        ]);

        $this->reset(["openCrear","fecha","tipo"]);
        $this->emitTo("show-citas","refreshCitas");
        $this->emit("mensaje", "Cita Creada");
    }

    // Función para cerrar la ventana modal si se pulsa el botón cancelar
    public function cerrar(){
        $this->reset(["openCrear","fecha","tipo"]);
    }
}
