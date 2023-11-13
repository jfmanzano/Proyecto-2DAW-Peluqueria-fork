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
                <li class="flex items-center">Marcas</li>
            </ol>
        </nav>
        <article class="flex mb-3">
            <div class="flex-1">
                <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
            </div>
            <div>
                @livewire('create-marcas')
            </div>
        </article>
        @if ($marcas->count())
            <article class="flex flex-wrap justify-around">
                @foreach ($marcas as $item)
                    <div
                        class="flex flex-col my-2 w-full items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl dark:border-gray-700 dark:bg-gray-800">
                        <img class="object-cover w-full rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="{{ Storage::url($item->imagen) }}" alt="imagen de {{ $item->nombre }}">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $item->nombre }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item->descripcion }}</p>
                            <div class="flex justify-center">
                                <button data-tooltip-target="tooltip-borrarMarca" data-tooltip-placement="left"
                                    class="mx-2" wire:click="confirmar('{{ $item->id }}')"
                                    wire:loading.attr="disabled" title="Borrar Marca">
                                    <i class="fas fa-trash text-red-600"></i>
                                </button>
                                <div id="tooltip-borrarMarca" role="tooltip"
                                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Borrar Marca
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <button data-tooltip-target="tooltip-editarMarca" data-tooltip-placement="right"
                                    wire:click="editar('{{ $item->id }}')" wire:loading.attr="disabled"
                                    title="Editar Marca">
                                    <i class="fas fa-edit text-yellow-600"></i>
                                </button>
                                <div id="tooltip-editarMarca" role="tooltip"
                                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Editar Marca
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </article>
            <div class="mt-2">
                {{ $marcas->links() }}
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
                        <x-form-textarea name="miMarca.descripcion" label="Descripción" />
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
    </main>
</x-miscomponentes.tablas>
