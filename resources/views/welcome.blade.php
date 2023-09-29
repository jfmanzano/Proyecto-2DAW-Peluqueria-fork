<x-app-layout>
    <x-miscomponentes.tablas>
        <main class="text-center">
            <h1 class="font-effect-neon text-4xl">Peluquerias Dbarb</h1>
            <figure>
                <a href="{{ route('dashboard') }}">
                    <img src="{{ Storage::url('logo.png') }}" alt="imagen del logo" class="mx-auto">
                </a>
            </figure>
        </main>
        <footer class="text-center">
            <figure class="flex flex-wrap items-center justify-center">
                <figcaption class="flex">Página realizada por: Daniel Calatrava González</figcaption>
                <img alt="Licencia de Creative Commons" style="border-width:0"
                    src="https://i.creativecommons.org/l/by/4.0/88x31.png" class="flex ml-2" />
            </figure>
            <p>Esta obra está bajo una <a rel="license" target="_blank" style="color: blue;"
                    href="http://creativecommons.org/licenses/by/4.0/">licencia de Creative Commons
                    Reconocimiento 4.0 Internacional</a>.
            </p>
        </footer>
    </x-miscomponentes.tablas>
</x-app-layout>
