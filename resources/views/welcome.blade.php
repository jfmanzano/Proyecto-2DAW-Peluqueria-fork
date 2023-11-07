<x-app-layout>
    <x-miscomponentes.tablas>
        <main class="text-center">
            <div class="flex flex-row-reverse mb-6 mr-6">
                <a data-tooltip-target="tooltip-manualpr" href="{{ Storage::url('pdfs/Manual_Primer_Usuario_Peluquerias_Dbarb.pdf') }}"
                    download="primer_usuario.pdf" target="_blank" title="Manual de Primer Usuario">
                    <i class="fa-solid fa-circle-info text-blue-700 fa-2xl"></i>
                </a>
                <div id="tooltip-manualpr" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Manual de Primer Usuario
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
            <h1 class="font-effect-neon text-4xl">Peluquerias Dbarb</h1>
            <figure>
                <a data-tooltip-target="tooltip-dashboard" data-tooltip-placement="right" href="{{ route('dashboard') }}">
                    <img src="{{ Storage::url('logo.png') }}" alt="imagen del logo" class="mx-auto">
                </a>
                <div id="tooltip-dashboard" role="tooltip"
                    class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Ir a Dashboard
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </figure>
        </main>
    </x-miscomponentes.tablas>
</x-app-layout>
