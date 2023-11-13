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
                <li class="flex items-center">Categorías</li>
            </ol>
        </nav>
        <article class="flex flex-row-reverse mb-3">
            <div>
                @livewire('create-categories')
            </div>
        </article>
        @if ($categorias->count())
        <table id="categorias" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="text-center" style="background-color: {{ $item->color }}">
                            <span @class([
                                'px-2 rounded-xl dark:bg-gray-500 bg-white
                                dark:text-white border border-slate-700',
                            ])>{{ $item->nombre }}</span>
                        </td>
                        <td class="text-center">
                            <span @class([
                                'px-2 rounded-xl dark:bg-gray-500 bg-white
                                dark:text-white border border-slate-700',
                            ])>
                                <button data-tooltip-target="tooltip-borrarCategoria"
                                    data-tooltip-placement="left" wire:click="confirmar('{{ $item->id }}')"
                                    wire:loading.attr="disabled" title="Borrar Categoría">
                                    <i class="fas fa-trash text-red-600"></i>
                                </button>
                                <div id="tooltip-borrarCategoria" role="tooltip"
                                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Borrar Categoría
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <button data-tooltip-target="tooltip-editarCategoria"
                                    data-tooltip-placement="right" wire:click="editar('{{ $item->id }}')"
                                    wire:loading.attr="disabled" title="Editar Categoría">
                                    <i class="fas fa-edit text-yellow-600"></i>
                                </button>
                                <div id="tooltip-editarCategoria" role="tooltip"
                                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Editar Categoría
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    </main>
    <!--Realizo el script del Datatable-->
    <script>
        new DataTable('#categorias', {});
    </script>
</x-miscomponentes.tablas>
