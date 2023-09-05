<x-app-layout>
    <x-miscomponentes.tablas>
    <div class="flex mb-3">
        <div class="flex-1">
            <x-input class="w-full" type="search" placeholder="Buscar..." wire:model="buscar"></x-input>
        </div>
    </div>
    @if ($carro->count())
        <div class="mx-auto">
            <table
                class="table-auto border-collapse border border-slate-500
                text-sm text-left text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700
                 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Artículo
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Precio
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Imagen
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Cantidad
                        </th>
                        <th scope="col" class="text-center py-3 border border-slate-600">
                            Eliminar
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carro as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="w-1/5 py-4 text-center border border-slate-700">
                                {{ $item->article->nombre }}
                            </td>
                            <td class="w-1/5 py-4 text-center border border-slate-700">
                                <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->article->precio }} €</p>
                            </td>
                            <td class="w-1/5 py-4 border border-slate-700">
                                <img src="{{ Storage::url($item->article->imagen) }}" 
                                alt="imagen de {{ $item->article->nombre }}"
                                    class="mx-auto w-1/2">
                            </td>
                            <td class="w-1/5 py-4 text-center border border-slate-700">
                                <p class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->cantidad }} </p>
                            </td>
                            <td class="w-1/5 py-4 text-center border border-slate-700">
                                <button wire:click="borrar('{{ $item->article->id }}')" wire:loading.attr="disabled">
                                    <i class="fas fa-trash text-red-600"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $carro->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ningún artículo en el carro</p>
    @endif
</x-miscomponentes.tablas>
</x-app-layout>