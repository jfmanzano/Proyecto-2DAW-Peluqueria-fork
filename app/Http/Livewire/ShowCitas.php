<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;
use Livewire\WithPagination;
//Librería que utilizo para sacar fecha actual del sistema
use Carbon\Carbon;

class ShowCitas extends Component
{
    use WithPagination;

    public string $buscar = "", $campo="fecha", $orden="desc";
    public bool $openEditar = false;
    public Cita $miCita;

    protected $listeners = [
        'refreshCitas' => 'render',
        'borrarCita' => 'borrar'
    ];
    public function render()
    {
        $citas = Cita::where('fecha', 'like', "%{$this->buscar}%")
        ->orderBy($this->campo, $this->orden)
        ->paginate(2);
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('d/m/Y H:i');
        return view('livewire.show-citas', compact('citas','fechaActual'));
    }

    public function ordenar(string $campo){
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function updatingBuscar(){
        $this->resetPage();
    }

    public function borrar(Cita $cita){
        //Borramos el registro de la base de datos
        $cita->delete();
        //Emitimos un mensaje
        $this->emit('mensaje', 'Cita borrada con éxito');
        return redirect('/citas');
    }

    public function confirmar(Cita $cita){
        $this->emit('permisoBorrar4', $cita->id);
    }

    public function editar(Cita $miCita){
        $this->miCita = $miCita;
        $this->openEditar = true;
    }

    protected function rules(): array
    {
        $fechaActual = Carbon::now()->tz('Europe/Madrid');
        $fechaActual = $fechaActual->format('d/m/Y H:i');
        return [
            'miCita.fecha' => ['required', 'date_format:d/m/Y H:i', 'after_or_equal:'.$fechaActual,  
            'regex:~^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4} (0[9]|1[0-9]|2[0-1]):[0-5][0-9]$~',
            'unique:citas,fecha'],
            'miCita.tipo' => ['required', 'in:Pelado,Lavado,Tinte,Peinado'],
        ];
    }

    public function update(){
        $this->validate();
        $this->miCita->save();
        $this->emit('mensaje', 'Cita Actualizada');
        $this->reset(['openEditar']);
    }
}
