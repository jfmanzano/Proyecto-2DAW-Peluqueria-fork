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
                @auth
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
                @endauth
                <li class="flex items-center">Contáctanos</li>
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
                <button data-tooltip-target="tooltip-enviar" type="submit"
                    class="bg-blue-500 ml-2 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    title="Enviar Correo Contacto">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
                <div id="tooltip-enviar" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Enviar Correo Contacto
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a data-tooltip-target="tooltip-cancelar" href="{{ route('inicio') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" title="Cancelar">
                    <i class="fas fa-backward"></i> Cancelar
                </a>
                <div id="tooltip-cancelar" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Cancelar
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </form>
    </x-miscomponentes.tablas>
</x-app-layout>
