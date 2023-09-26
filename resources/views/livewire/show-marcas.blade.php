<x-miscomponentes.tablas>
    <main>
        <nav aria-label="Migas de Pan (Breadcrumbs)" class="mb-2 ml-2">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/">Inicio</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
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
                        class="flex flex-col my-2 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl dark:border-gray-700 dark:bg-gray-800">
                        <img class="md:object-cover w-full rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                            src="{{ Storage::url($item->imagen) }}" alt="imagen de {{ $item->nombre }}">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $item->nombre }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item->descripcion }}</p>
                            <div class="flex justify-end">
                                <button class="mx-2" wire:click="confirmar('{{ $item->id }}')"
                                    wire:loading.attr="disabled" title="Borrar Marca">
                                    <i class="fas fa-trash text-red-600"></i>
                                </button>
                                <button wire:click="editar('{{ $item->id }}')" wire:loading.attr="disabled"
                                    title="Editar Marca">
                                    <i class="fas fa-edit text-yellow-600"></i>
                                </button>
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
    </main>
</x-miscomponentes.tablas>
