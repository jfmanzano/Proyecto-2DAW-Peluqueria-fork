<x-app-layout>
    <x-miscomponentes.tablas>
        <nav aria-label="Migas de Pan (Breadcrumbs)" class="mb-2 ml-2">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/">Inicio</a>
                </li>
                <li class="mx-2">
                    <i class="fa-solid fa-chevron-right "></i>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="mx-2">
                    <i class="fa-solid fa-chevron-right "></i>
                </li>
                <li class="flex items-center">Carro</li>
            </ol>
        </nav>
        @if ($carro->count())
            <div class="flex flex-wrap">
                @foreach ($carro as $item)
                    <div
                        class="flex flex-col mx-auto my-2 h-1/2 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <img class="p-8 h-96 rounded-t-lg" src="{{ Storage::url($item->article->imagen) }}"
                            alt="imagen de {{ $item->article->nombre }}" />
                        <div class="px-5 pb-5">
                            <h5 class="text-2xl font-bold text-gray-900 dark:text-white text-center">
                                {{ $item->article->nombre }}</h5>
                            <div class="flex items-center justify-around text-center">
                                <form action="{{ route('carro.update', $item) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="number" min="1" max="{{ $item->article->stock }}"
                                        name="cantidad" value="{{ $item->cantidad }}"
                                        class="w-16 text-center h-6 text-gray-800 outline-none rounded border border-blue-600" />
                                    <button
                                        class="px-4 mt-1 ml-2 py-1.5 text-sm rounded shadow text-violet-100 bg-violet-500">Actualizar</button>
                                </form>
                                <div>
                                    <form action="{{ route('carro.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Eliminar artículo">
                                            <i class="fas fa-trash text-red-600"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-wrap justify-between mx-2">
                <div class="flex flex-col">
                    Total del carro: {{ $total }} €
                </div>
                <div class="flex flex-col">
                    <form action="{{ route('carro.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Eliminar carro">
                            <i class="fa-solid fa-dumpster text-red-600"></i>
                        </button>
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
