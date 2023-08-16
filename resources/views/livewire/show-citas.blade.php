<x-miscomponentes.tablas>
    <div class="flex w-full mb-2">
        <div class="w-full flex-1">
            <x-input type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
        </div>
        <div class="ml-4">
            @livewire('create-citas')
        </div>
    </div>
    @if ($citas->count())
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-3 cursor-pointer" wire:click="ordenar('fecha')">
                            <i class="fas fa-sort mr-2"></i> Fecha y Hora
                        </th>
                        <th scope="col" class="px-3 py-3 cursor-pointer" wire:click="ordenar('tipo')">
                            <i class="fas fa-sort mr-2"></i> Tipo
                        </th>
                        <th scope="col" class="px-6 py-3"> Nombre de Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $item->fecha }}
                            </td>
                            <td class="px-6 py-4 ">
                                {{ $item->tipo }}
                            </td>
                            <td class="px-6 py-4 ">
                                <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->user->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="confirmar('{{ $item->id }}')" wire:loading.attr="disabled">
                                    <i class="fas fa-trash text-red-600"></i>
                                </button>
                                <button wire:click="editar('{{ $item->id }}')" wire:loading.attr="disabled">
                                    <i class="fas fa-edit text-yellow-600"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $citas->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ninguna cita o no se ha creado ninguna</p>
    @endif
    <!--Modal para editar-->
    <x-dialog-modal wire:model="openEditar">
        <x-slot name="title">
            Editar Cita
        </x-slot>
        <x-slot name="content">
            @wire($miCita, 'defer')
            <x-form-input name="miCita.fecha"
            min="{{$fechaActual}}" label="Fecha y hora de la cita" placeholder="Ejemplo: 24/12/2023 09:30"/>            
            <x-form-group name="miCita.tipo" label="Tipo de Cita" inline>
                <x-form-radio name="miCita.tipo" value="Pelado" label="Pelado" />
                <x-form-radio name="miCita.tipo" value="Lavado" label="Lavado" />
                <x-form-radio name="miCita.tipo" value="Tinte" label="Tinte" />
                <x-form-radio name="miCita.tipo" value="Peinado" label="Peinado" />
            </x-form-group>
            @endwire
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="cerrar()">
                    <i class="fas fa-xmark mr-2"></i>Cancelar
                </button>
                <button class="mr-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="update()" wire:loading.attr="disabled">
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</x-miscomponentes.tablas>
