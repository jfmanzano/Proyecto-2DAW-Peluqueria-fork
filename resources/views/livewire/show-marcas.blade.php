<x-miscomponentes.tablas>
    <div class="flex mb-3">
        <div class="flex-1">
            <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
        </div>
        <div>
            @livewire('create-marcas')
        </div>
    </div>
    @if ($marcas->count())
        <div class="relative overflow-x-auto">
            <table
                class="table-auto border-collapse border border-slate-500
                text-sm text-left text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700
                 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="text-center py-3 cursor-pointer border border-slate-600"
                            wire:click="ordenar('nombre')">
                            <i class="fas fa-sort mr-2"></i> Nombre
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Descripcion
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Imagen
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="text-center border border-slate-700">
                                {{ $item->nombre }}
                            </td>
                            <td class="text-center border border-slate-700">
                                <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->descripcion }}</p>
                            </td>
                            <td class="border border-slate-700">
                                <img src="{{ Storage::url($item->imagen) }}" alt="imagen de {{ $item->nombre }}"
                                    class="mx-auto w-1/2">
                            </td>
                            <td class="text-center border border-slate-700">
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
                {{ $marcas->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ninguna marca o no se ha creado ninguna</p>
    @endif
    <!--Modal para editar-->
    @if ($miMarca)
        <x-dialog-modal wire:model="openEditar">
            <x-slot name="title">
                Editar Marca
            </x-slot>
            <x-slot name="content">
                @wire($miMarca, 'defer')
                    <x-form-input name="miMarca.nombre" label="Nombre de la marca" />
                    <x-form-textarea name="miMarca.descripcion" id="descripcion" label="Descripción" />
                @endwire
                <div class="mt-2 relative">
                    @if ($imagen)
                        <button wire:click="$set('imagen')"
                            class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cambiar Imagen</button>
                        <img class="object-center object-cover border-lg" src="{{ $imagen->temporaryUrl() }}" />
                    @else
                        <img src="{{ Storage::url($miMarca->imagen) }}"
                            class="object-center object-cover border-dashed">
                        <label for="imgEditar"
                            class="absolute bottom-2 right-2 bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Imagen</label>
                    @endif
                    <input id="imgEditar" type="file" name="imagen" wire:model="imagen" accept="image/*"
                        class="hidden" />
                    @error('imagen')
                        <p class="text-xs text-red-500 mt-2 italic">{{ $message }}</p>
                    @enderror
                </div>
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
