<x-app-layout>
    <x-miscomponentes.tablas>
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
                <li class="flex items-center">Carro</li>
            </ol>
        </nav>
        <div class="flex flex-row-reverse mx-6 my-auto">
            <a href="{{ route('articulos.show') }}" class="max-sm:mx-auto">
                <button data-tooltip-target="tooltip-articulos"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" title="Ir a Artículos">
                    <i class="fa-solid fa-tags"></i><span class="max-sm:hidden"> Ir a Artículos</span>
                </button>
                <div id="tooltip-articulos" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Ir a Artículos
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </a>
        </div>
        @if ($carro->count())
            <div class="flex flex-wrap">
                @foreach ($carro as $item)
                    <div
                        class="flex flex-col mx-auto my-2 h-1/2 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <img class="p-8 h-96 rounded-t-lg" src="{{ Storage::url($item->article->imagen) }}"
                            alt="imagen de {{ $item->article->nombre }}" />
                        <div class="px-5 pb-5">
                            <h5 class="text-2xl py-2 font-bold text-gray-900 dark:text-white text-center">
                                {{ $item->article->nombre }}</h5>
                            <div class="flex items-center justify-around text-center">
                                <form action="{{ route('carro.update', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="number" min="1" max="{{ $item->article->stock }}"
                                        name="cantidad" value="{{ $item->cantidad }}"
                                        class="w-16 text-center h-6 text-gray-800 outline-none rounded border border-blue-600" />
                                    <button data-tooltip-target="tooltip-editar" title="Editar Cantidad"
                                        class="px-4 mt-1 ml-2 py-1.5 text-sm rounded shadow text-violet-100 bg-violet-500">
                                        Actualizar
                                    </button>
                                    <div id="tooltip-editar" role="tooltip"
                                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Editar Cantidad
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </form>
                                <div>
                                    <form action="{{ route('carro.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button data-tooltip-target="tooltip-borrar" type="submit"
                                            title="Quitar Artículo">
                                            <i class="fas fa-trash text-red-600"></i>
                                        </button>
                                        <div id="tooltip-borrar" role="tooltip"
                                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Quitar Artículo
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h5 class="text-2xl py-2 font-bold text-gray-900 dark:text-white text-center">
                                Total Artículo: {{ $totalArticulo[$item->id] }} €</h5>
                            <h5 class="text-2xl py-2 font-bold text-gray-900 dark:text-white text-center">
                                Cantidad Actual: {{ $item->cantidad }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-wrap justify-between mx-2">
                <div class="flex flex-col">
                    Total del carro: {{ $totalCarro }} €
                </div>
                <div class="flex flex-col">
                    <form action="{{ route('carro.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-tooltip-target="tooltip-clear" type="submit" title="Eliminar Carro Completo">
                            <i class="fa-solid fa-dumpster text-red-600"></i>
                        </button>
                        <div id="tooltip-clear" role="tooltip"
                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Eliminar Carro Completo
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-2">
                {{ $carro->links() }}
            </div>
        @else
            <p class="font-bold italic text-red-600">No se encontró ningún artículo en el carro</p>
        @endif
    </x-miscomponentes.tablas>
</x-app-layout>
