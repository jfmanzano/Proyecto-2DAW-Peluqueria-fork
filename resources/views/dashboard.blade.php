<x-app-layout>
    <x-miscomponentes.tablas>
    <div class="flex mb-3">
        <div class="flex-1">
            <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
        </div>
    </div>
    @if ($articles->count())
        <div class="mx-auto">
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
                            Precio
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Imagen
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Añadir al carro
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="text-center border border-slate-700 w-1/4">
                                {{ $item->nombre }}
                            </td>
                            <td class="text-center border border-slate-700 w-1/4">
                                <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->precio }} €</p>
                            </td>
                            <td class="border border-slate-700 w-1/4">
                                <img src="{{ Storage::url($item->imagen) }}" alt="imagen de {{ $item->nombre }}"
                                    class="mx-auto w-1/2">
                            </td>
                            <td class="text-center border border-slate-700 w-1/4">
                                <button wire:click="confirmar('{{ $item->id }}')" wire:loading.attr="disabled">
                                    <i class="fas fa-add text-blue-600"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $articles->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ninguna marca o no se ha creado ninguna</p>
    @endif
</x-miscomponentes.tablas>
</x-app-layout>
