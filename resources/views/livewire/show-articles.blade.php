<x-miscomponentes.tablas>
    <div class="flex mb-3">
        <div class="flex-1">
            <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
        </div>
        <div>
            @livewire('create-articles')
        </div>
    </div>
    @if ($articulos->count())
        <div class="relative overflow-x-auto">
            <table
                class="w-full border-collapse border border-slate-500 text-center
                text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3">
                            Detalle
                        </th>
                        <th scope="col" class="py-3 cursor-pointer border border-slate-600"
                            wire:click="ordenar('nombre')">
                            <i class="fas fa-sort mr-2"></i> Nombre
                        </th>
                        <th scope="col" class="py-3 cursor-pointer border border-slate-600"
                            wire:click="ordenar('disponible')">
                            <i class="fas fa-sort mr-2"></i> Disponible
                        </th>
                        <th scope="col" class="py-3 border border-slate-600"> Stock
                        </th>
                        <th scope="col" class="py-3 border border-slate-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articulos as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="w-1/5 py-4 border border-slate-700">
                                <button wire:click="detalle ({{ $item }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-info"></i>
                                </button>
                            </td>
                            <td class="w-1/5 py-4 border border-slate-700">
                                {{ $item->nombre }}
                            </td>
                            <td class="w-1/5 py-4 border border-slate-700 cursor-pointer" 
                            wire:click="cambiarDisponibilidad('{{ $item->id }}')">
                                <p><span @class([
                                    'py-2 rounded-md',
                                    'text-red-600 font-bold line-through' => $item->disponible == 'NO',
                                    'text-green-600 font-bold' => $item->disponible == 'SI',
                                ])
                                >{{ $item->disponible }}</span></p>
                            </td>
                            <td class="w-1/5 py-4 border border-slate-700">
                                <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->stock }} unidades</p>
                            </td>
                            <td class="w-1/5 py-4 border border-slate-700">
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
                {{ $articulos->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ningun artículo o no se ha creado ninguno</p>
    @endif
    <!--Modal para detalle-->
    @if ($articulo)
        <x-dialog-modal wire:model="openDetalle">
            <x-slot name="title">
                Detalle Artículo
            </x-slot>

            <x-slot name="content">
                <div class="flex justify-center">
                    <div class="rounded-lg shadow-lg bg-white max-w-sm">
                        <div class="p-6">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">Nombre del artículo: <br>
                                {{ $articulo->nombre }}</h5>
                            <p class="text-gray-700 text-base mb-4">
                                Descripción: {{ $articulo->descripcion }}
                            </p>
                            <p class="text-base mb-4">
                                Disponible: <span @class([
                                    'px-2 py-1 rounded-xl border-xl',
                                    'bg-red-500' => $articulo->disponible == 'NO',
                                    'bg-green-500' => $articulo->disponible == 'SI',
                                ])>{{ $articulo->disponible }}</span>
                            </p>
                            <p class="text-gray-700 text-base mb-4">
                                Precio: {{ $articulo->precio }} €
                            </p>
                            <p class="text-gray-700 text-base mb-4">
                                Stock: {{ $articulo->stock }} unidades
                            </p>
                            <p class="text-gray-700 text-base mb-4"
                                style="background-color: {{ $articulo->category->color }}">
                                Categoría: {{ $articulo->category->nombre }}
                            </p>
                            <p class="text-gray-700 text-base mb-4">
                                Marca: {{ $articulo->marca->nombre }}
                            </p>
                            <img class="rounded-t-lg" src="{{ Storage::url($articulo->imagen) }}"
                                alt="imagen de {{ $articulo->nombre }}" />
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button wire:click="$set('openDetalle')"
                        class="mr-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-backward"></i> Volver
                    </button>
                </div>
            </x-slot>
    @endif
    </x-dialog-modal>
    <!--Cierre de modal detalle-->
    <!--Modal de editar-->
    @if ($miArticulo)
        <x-dialog-modal wire:model="openEditar">
            <x-slot name="title">
                Editar Artículo
            </x-slot>
            <x-slot name="content">
                @wire($miArticulo, 'defer')
                    <x-form-input name="miArticulo.nombre" label="Nombre del artículo" />
                    <x-form-textarea name="miArticulo.descripcion" id="descripcion" label="Descripción" />
                    <x-form-group name="miArticulo.disponible" label="Artículo Disponible?" inline>
                        <x-form-radio name="miArticulo.disponible" value="SI" label="Si" />
                        <x-form-radio name="miArticulo.disponible" value="NO" label="No" />
                    </x-form-group>
                    <x-form-input name="miArticulo.precio" type="number" step="0.01" label="Precio del artículo" />
                    <x-form-input name="miArticulo.stock" type="number" step="1" label="Número de unidades (stock)" />
                    <x-form-select name="miArticulo.category_id" :options="$categories" label="Categoría" />
                    <x-form-select name="miArticulo.marca_id" :options="$marcas" label="Marca" />
                @endwire
                <div class="mt-2 relative">
                    @if ($imagen)
                        <button wire:click="$set('imagen')"
                            class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cambiar Imagen</button>
                        <img class="object-center object-cover border-lg" src="{{ $imagen->temporaryUrl() }}" />
                    @else
                        <img src="{{ Storage::url($miArticulo->imagen) }}"
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
                    <button class="mr-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        wire:click="update()" wire:loading.attr="disabled">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif
    <!--Cierre de modal editar-->
</x-miscomponentes.tablas>
