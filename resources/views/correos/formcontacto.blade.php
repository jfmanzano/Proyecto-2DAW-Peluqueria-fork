<x-app-layout>
    <x-miscomponentes.tablas>
        <nav aria-label="Migas de Pan (Breadcrumbs)" class="mb-2 ml-2">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="/">Inicio</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                @auth
                    <li class="flex items-center">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                @endauth
                <li class="flex items-center">Artículos</li>
            </ol>
        </nav>
        <form name="formulario_contacto" action="{{ route('contacto.procesar') }}" method="POST">
            @csrf
            <x-form-input name="nombre" label="Nombre del Contacto" placeholder="Su nombre..." />
            @auth
                @bind(auth()->user())
                    <x-form-input name="email" label="Email de Contacto" readonly />
                @endbind
            @else
                <x-form-input name="email" label="Email de Contacto" />
            @endauth
            <x-form-textarea name="contenido" rows="4" placeholder="Déjenos su mensaje..." label="Contenido" />
            <div class="flex flex-row-reverse mt-3">
                <button type="submit"
                    class="bg-blue-500 ml-2 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
                <a href="{{ route('dashboard') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-backward"></i> Cancelar
                </a>
            </div>
        </form>
    </x-miscomponentes.tablas>
</x-app-layout>
