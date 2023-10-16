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
        $fechaActual = $fechaActual->format('Y-m-dTh:i');
        return view('livewire.create-citas',compact('fechaActual'));
    }

    protected function rules(): array
    {
        // Validaciones
        // Aquí meto la variable fechaActual para que compruebe que no se creen citas antes del día de hoy
        $fechaActual = Carbon::now()->tz('Europe/Madrid');
        $fechaActual = $fechaActual->format('Y-m-dTh:i');
        // Aquí me creo una variable para borrar las letras de la fecha actual ya que va con CEST
        // por el timezone(tz). La T no la borro porque la necesito para la validación del datetime-local
        // ya que va con una T como separador
        $letras = ["C","E","S"];
        $fechaActual = str_replace($letras,"",$fechaActual);
        return [
            'fecha' => ['required', 'after_or_equal:'.$fechaActual,  
            'regex:/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])T(0[9]|1\d|2[01]):[0-5]\d$/',
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
