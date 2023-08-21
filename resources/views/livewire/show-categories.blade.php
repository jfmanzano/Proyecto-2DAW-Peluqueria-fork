<x-miscomponentes.tablas>
    <div class="flex mb-3">
        <div class="flex-1">
            <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
        </div>
        <div>
            @livewire('create-categories')
        </div>
    </div>
    @if ($categorias->count())
        <div class="relative overflow-x-auto">
            <table
                class="w-full text-center border-collapse border border-slate-500 
                text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700
                 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 cursor-pointer border border-slate-600"
                            wire:click="ordenar('nombre')">
                            <i class="fas fa-sort mr-2"></i> Nombre
                        </th>
                        <th scope="col" class="py-3 border border-slate-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td style="background-color: {{ $item->color }}">
                                <span @class(['px-2 rounded-xl bg-gray-700 border border-slate-700'])>{{ $item->nombre }}</span>
                            </td>
                            <td class="py-4 border border-slate-700">
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
                {{ $categorias->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ninguna categoría o no se ha creado ninguna</p>
    @endif
    <!--Modal para editar-->
    @if ($miCategory)
        <x-dialog-modal wire:model="openEditar">
            <x-slot name="title">
                Editar Categoría
            </x-slot>
            <x-slot name="content">
                @wire($miCategory, 'defer')
                    <x-form-input name="miCategory.nombre" label="Nombre de la categoría" />
                    <x-form-input name="miCategory.color" type="color" label="Color" />
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
    @endif
</x-miscomponentes.tablas>
