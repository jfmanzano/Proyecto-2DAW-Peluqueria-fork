<x-app-layout>
    <x-miscomponentes.tablas>
        <main>
            <nav aria-label="Migas de Pan (Breadcrumbs)" class="mb-2 ml-2">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a data-tooltip-target="tooltip-inicio" href="/"
                            class="hover:text-blue-700 text-blue-900" title="Ir a Inicio">Inicio
                        </a>
                        <div id="tooltip-inicio" role="tooltip"
                            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Ir a Inicio
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </li>
                    <li class="mx-2">
                        <i class="fa-solid fa-chevron-right "></i>
                    </li>
                    <li class="flex items-center">Dashboard</li>
                    <li class="mx-2">
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>
                    <li>
                        @if (!auth()->user()->is_admin)
                            <a data-tooltip-target="tooltip-usuario"
                                href="{{ Storage::url('pdfs/Manual_Usuario_Peluquerias_Dbarb.pdf') }}"
                                download="usuario.pdf" target="_blank" title="Manual de Usuario">
                                <i class="fa-solid fa-circle-info text-blue-700"></i>
                            </a>
                            <div id="tooltip-usuario" role="tooltip"
                                class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Manual de Usuario
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        @else
                            <a data-tooltip-target="tooltip-administrador"
                                href="{{ Storage::url('pdfs/Manual_Administrador_Peluquerias_Dbarb.pdf') }}"
                                download="administrador.pdf" target="_blank" title="Manual de Administrador">
                                <i class="fa-solid fa-circle-info text-blue-700"></i>
                            </a>
                            <div id="tooltip-administrador" role="tooltip"
                                class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Manual de Administrador
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        @endif
                    </li>
                </ol>
            </nav>
            <article class="text-4xl text-center"> Peluquerias Dbarb</article>
            <article class="text-2xl text-center"> Seleccione lo que necesite:</article>
            <article class="flex flex-wrap justify-around sm:mt-5">
                @if (auth()->user()->is_admin)
                    <a data-tooltip-target="tooltip-categorias"
                        class="shadow-md rounded-lg my-4 text-blue-600 hover:text-gray-900
                      hover:bg-blue-500 border border-blue-600 hover:border-white cursor-pointer mx-2"
                        href="{{ route('categorias.show') }}"><i class="fa-solid fa-magnifying-glass fa-6x"
                            title="Gestionar Categorías"></i>
                    </a>
                    <div id="tooltip-categorias" role="tooltip"
                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Gestionar Categorías
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <a data-tooltip-target="tooltip-marcas"
                        class="shadow-md rounded-lg my-4 text-blue-600 hover:text-gray-900
                      hover:bg-blue-500 border border-blue-600 hover:border-white cursor-pointer mx-2"
                        href="{{ route('marcas.show') }}"><i class="fa-solid fa-briefcase fa-6x"
                            title="Gestionar Marcas"></i>
                    </a>
                    <div id="tooltip-marcas" role="tooltip"
                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Gestionar Marcas
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                @endif
                <a data-tooltip-target="tooltip-articulos"
                    class="shadow-md rounded-lg my-4 text-blue-600 hover:text-gray-900
                  hover:bg-blue-500 border border-blue-600 hover:border-white cursor-pointer mx-2"
                    href="{{ route('articulos.show') }}" title="Ver Artículos">
                    <i class="fa-solid fa-tags fa-6x"></i>
                </a>
                <div id="tooltip-articulos" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Ver Artículos
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <a data-tooltip-target="tooltip-citas"
                    class="shadow-md rounded-lg my-4 text-blue-600 hover:text-gray-900
                  hover:bg-blue-500 border border-blue-600 hover:border-white cursor-pointer mx-2"
                    href="{{ route('citas.show') }}"><i class="fa-solid fa-address-book fa-6x"
                        title="Gestionar Citas"></i>
                </a>
                <div id="tooltip-citas" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Gestionar Citas
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                @if (auth()->user()->carros()->count())
                    <a data-tooltip-target="tooltip-carro"
                        class="shadow-md rounded-lg my-4 text-blue-600 hover:text-gray-900
                      hover:bg-blue-500 border border-blue-600 hover:border-white cursor-pointer mx-2"
                        href="{{ route('carro.index') }}"><i class="fa-solid fa-cart-shopping fa-6x"
                            title="Gestionar Carro"></i>
                    </a>
                    <div id="tooltip-carro" role="tooltip"
                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Gestionar Carro
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                @endif
                <a data-tooltip-target="tooltip-contacto"
                    class="shadow-md rounded-lg my-4 text-blue-600 hover:text-gray-900
                  hover:bg-blue-500 border border-blue-600 hover:border-white cursor-pointer mx-2"
                    href="{{ route('contacto.pintar') }}"><i class="fa-solid fa-envelope fa-6x" title="Contáctanos"></i>
                </a>
                <div id="tooltip-contacto" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Contáctanos
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </article>
        </main>
    </x-miscomponentes.tablas>
</x-app-layout>
