<x-app-layout>
    <div class="px-12 mb-4">
        <div class="font-bold text-xl text-center"></div>
        @foreach ($marcas as $marca)
            <div class="my-5 bg-gray-200 rounded text-center">
                <a href="#">
                    <p class="text-gray-700 text-xl">
                        {{ $marca->nombre }}
                    </p>
                    <img src="{{ Storage::url($marca->imagen) }}" alt="imagen de la marca {{$marca->nombre}}" class="mx-auto">
                </a>
            </div>
        @endforeach
        {{$marcas->links()}}
    </div>
</x-app-layout>
