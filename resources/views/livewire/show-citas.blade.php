<x-miscomponentes.tablas>
    <main>
        <nav aria-label="Migas de Pan (Breadcrumbs)" class="mb-2 ml-2">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/" class="hover:text-blue-700 text-blue-900">Inicio</a>
                </li>
                <li class="mx-2">
                    <i class="fa-solid fa-chevron-right "></i>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700 text-blue-900">Dashboard</a>
                </li>
                <li class="mx-2">
                    <i class="fa-solid fa-chevron-right "></i>
                </li>
                <li class="flex items-center">Citas</li>
            </ol>
        </nav>
        <article class="flex mb-3">
            <div class="flex-1">
                <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
            </div>
            <div>
                @livewire('create-citas')
            </div>
        </article>
        @if ($citas->count())
            <article class="relative overflow-x-auto">
                <table
                    class="w-full text-center border-collapse border border-slate-500 
                text-sm text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 cursor-pointer border border-slate-600"
                                wire:click="ordenar('fecha')">
                                <i class="fas fa-sort mr-2"></i> Fecha y Hora
                            </th>
                            <th scope="col" class="py-3 cursor-pointer border border-slate-600"
                                wire:click="ordenar('tipo')">
                                <i class="fas fa-sort mr-2"></i> Tipo
                            </th>
                            <th scope="col" class="py-3 border border-slate-600">
                                Nombre de Usuario
                            </th>
                            <th scope="col" class="py-3 border border-slate-600">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 border border-slate-700">
                                    {{ $item->fecha }}
                                </td>
                                <td class="py-4 border border-slate-700">
                                    {{ $item->tipo }}
                                </td>
                                <td class="py-4 border border-slate-700">
                                    <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                        {{ $item->user->name }}</p>
                                </td>
                                <td class="py-4 border border-slate-700">
                                    <button wire:click="confirmar('{{ $item->id }}')" wire:loading.attr="disabled"
                                        title="Borrar Cita">
                                        <i class="fas fa-trash text-red-600"></i>
                                    </button>
                                    <button wire:click="editar('{{ $item->id }}')" wire:loading.attr="disabled"
                                        title="Editar Cita">
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
            </article>
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
                    <x-form-input name="miCita.fecha" min="{{ $fechaActual }}" label="Fecha y hora de la cita"
                        placeholder="Ejemplo: 24/12/2023 09:30" />
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
                        wire:click="$set('openEditar', false)">
                        <i class="fas fa-xmark mr-2"></i>Cancelar
                    </button>
                    <button class="mr-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                            wire:click="update" wire:loading.attr="disabled">
                            <i class="fas fa-save mr-2"></i>Editar
                        </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </main>
</x-miscomponentes.tablas>
