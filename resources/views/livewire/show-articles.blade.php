<x-miscomponentes.tablas>
    <main>
        <nav aria-label="Migas de Pan (Breadcrumbs)" class="mb-2 ml-2">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a data-tooltip-target="tooltip-inicio" href="/" class="hover:text-blue-700 text-blue-900"
                        title="Ir a Inicio">Inicio</a>
                    <div id="tooltip-inicio" role="tooltip"
                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Ir a Inicio
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </li>
                <li class="mx-2">
                    <i class="fa-solid fa-chevron-right "></i>
                </li>
                <li class="flex items-center">
                    <a data-tooltip-target="tooltip-dashboard" href="{{ route('dashboard') }}"
                        class="hover:text-blue-700 text-blue-900" title="Ir a Dashboard">Dashboard</a>
                    <div id="tooltip-dashboard" role="tooltip"
                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Ir a Dashboard
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </li>
                <li class="mx-2">
                    <i class="fa-solid fa-chevron-right "></i>
                </li>
                <li class="flex items-center">Artículos</li>
            </ol>
        </nav>
        <article class="flex mb-3">
            <div class="flex-1">
                <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
            </div>
            @if (auth()->user()->carros()->count())
                <div class="flex flex-row-reverse mx-6 my-auto">
                    <a data-tooltip-target="tooltip-carro" href="{{ route('carro.index') }}">
                        <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                            title="Ir al Carro">
                            <i class="fa-solid fa-cart-shopping"></i><span class="max-sm:hidden"> Ir al Carro</span>
                        </button>
                        <div id="tooltip-carro" role="tooltip"
                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Ir al Carro
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </a>
                </div>
            @endif
            @if (auth()->user()->is_admin)
                <div>
                    @livewire('create-articles')
                </div>
            @endif
        </article>
        @if ($articulos->count())
            @if (auth()->user()->is_admin)
                <div class="flex flex-wrap">
                    @foreach ($articulos as $item)
                        <article
                            class="flex flex-col mx-auto my-2 h-1/2 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img data-tooltip-target="tooltip-imagen" wire:click="detalle ({{ $item }})"
                                class="p-8 h-96 rounded-t-lg cursor-pointer" src="{{ Storage::url($item->imagen) }}"
                                alt="imagen de {{ $item->nombre }}" title="Ver Detalles Del Artículo" />
                            <div id="tooltip-imagen" role="tooltip"
                                class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Ver Detalles Del Artículo
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <div class="px-5 pb-5">
                                <h5 class="text-2xl font-bold text-gray-900 dark:text-white text-center">
                                    {{ $item->nombre }}</h5>
                                <div class="flex items-center justify-between text-center">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                                        {{ $item->stock }} unidades</span>
                                    <div>
                                        <p class="text-xl font-bold text-gray-900 dark:text-white">
                                            Disponible <span data-tooltip-target="tooltip-disponible"
                                                wire:click="cambiarDisponibilidad('{{ $item->id }}')"
                                                title="Cambiar Disponibilidad Artículo"
                                                @class([
                                                    'py-2 rounded-md cursor-pointer',
                                                    'text-red-600 font-bold line-through' => $item->disponible == 'NO',
                                                    'text-green-600 font-bold' => $item->disponible == 'SI',
                                                ])>{{ $item->disponible }}</span>
                                        </p>
                                        <div id="tooltip-disponible" role="tooltip"
                                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Cambiar Disponibilidad Artículo
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                    <div>
                                        <button data-tooltip-target="tooltip-borrarArticulo"
                                            wire:click="confirmar('{{ $item->id }}')" wire:loading.attr="disabled"
                                            title="Borrar Artículo">
                                            <i class="fas fa-trash text-red-600"></i>
                                        </button>
                                        <div id="tooltip-borrarArticulo" role="tooltip"
                                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Borrar Artículo
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                        <button data-tooltip-target="tooltip-editarArticulo"
                                            wire:click="editar('{{ $item->id }}')" wire:loading.attr="disabled"
                                            title="Editar Artículo">
                                            <i class="fas fa-edit text-yellow-600"></i>
                                        </button>
                                        <div id="tooltip-editarArticulo" role="tooltip"
                                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Editar Artículo
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="flex flex-wrap">
                    @foreach ($articulos as $item)
                        <article
                            class="flex flex-col mx-auto my-2 h-1/2 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img wire:click="detalle ({{ $item }})"
                                class="p-8 h-96 rounded-t-lg cursor-pointer" src="{{ Storage::url($item->imagen) }}"
                                alt="imagen de {{ $item->nombre }}" title="Ver Detalles Del Artículo" />
                            <div class="px-5 pb-5">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $item->nombre }}</h5>
                                <div class="flex items-center justify-between">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">
                                        {{ $item->precio }} €</span>
                                    @if (in_array($item->id, $arrayCarro))
                                        <button data-tooltip-target="tooltip-eliminarArticuloCarro" wire:click="eliminarArticuloCarro('{{ $item->id }}')"
                                            wire:loading.attr="disabled" title="Quitar Artículo Del Carro">
                                            <i class="fas fa-minus text-red-600"></i>
                                        </button>
                                        <div id="tooltip-eliminarArticuloCarro" role="tooltip"
                                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Quitar Artículo Del Carro
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    @else
                                        <button data-tooltip-target="tooltip-anadirArticuloCarro" wire:click="ponerEnCarro('{{ $item->id }}')"
                                            wire:loading.attr="disabled" title="Añadir Artículo al Carro">
                                            <i class="fas fa-add text-blue-600"></i>
                                        </button>
                                        <div id="tooltip-anadirArticuloCarro" role="tooltip"
                                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Añadir Artículo al Carro
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
            <div class="mt-2">
                {{ $articulos->links() }}
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
                        <x-form-textarea name="miArticulo.descripcion" label="Descripción" />
                        <x-form-group name="miArticulo.disponible" label="Artículo Disponible?" inline>
                            <x-form-radio name="miArticulo.disponible" value="SI" label="Si" />
                            <x-form-radio name="miArticulo.disponible" value="NO" label="No" />
                        </x-form-group>
                        <x-form-input name="miArticulo.precio" type="number" step="0.01"
                            label="Precio del artículo" />
                        <x-form-input name="miArticulo.stock" type="number" step="1"
                            label="Número de unidades (stock)" />
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
                        <button class="mr-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                            wire:click="update" wire:loading.attr="disabled">
                            <i class="fas fa-save mr-2"></i>Editar
                        </button>
                    </div>
                </x-slot>
            </x-dialog-modal>
        @endif
        <!--Cierre de modal editar-->
    </main>
</x-miscomponentes.tablas>
