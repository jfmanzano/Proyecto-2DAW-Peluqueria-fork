<x-app-layout>
    <x-miscomponentes.tablas>
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
                                <form name="disminuir" action="{{route('carro.update', $item, 1)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">
                                        <i class="fas fa-minus text-blue-600"></i>
                                    </button>
                                </form>
                                <span class="px-2 py-2 rounded-md text-gray-400 font-bold">
                                    {{ $item->cantidad }} </span>
                                    <form name="aumentar" action="{{route('carro.update', $item, 2)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">
                                            <i class="fas fa-add text-blue-600"></i>
                                        </button>
                                    </form>
                            </td>
                            <td class="w-1/5 py-4 text-center border border-slate-700">
                                <form action="{{route('carro.destroy', $item)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fas fa-trash text-red-600"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$total}}
            </div>
            <div>
                <form action="{{route('carro.clear')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <i class="fas fa-trash text-red-600"></i>
                    </button>
                </form>
            </div>
            <div class="mt-2">
                {{ $carro->links() }}
            </div>
        </div>
    @else
        <p class="font-bold italic text-red-600">No se encontró ningún artículo en el carro</p>
    @endif
</x-miscomponentes.tablas>
</x-app-layout>