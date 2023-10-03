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
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/">
                <a property="dct:title" rel="cc:attributionURL" href="https://github.com/dancg/Proyecto-2DAW-Peluqueria"
                    class="hover:text-blue-700 text-blue-900" target="_blank">Peluquerias
                    Dbarb</a> by <a rel="cc:attributionURL dct:creator" property="cc:attributionName"
                    href="https://github.com/dancg" class="hover:text-blue-700 text-blue-900" target="_blank"> Daniel
                    Calatrava González</a> is licensed under
                <a class="flex flex-wrap justify-center items-center hover:text-blue-700 text-blue-900"
                    href="http://creativecommons.org/licenses/by/4.0/?ref=chooser-v1" target="_blank"
                    rel="license noopener noreferrer"> Attribution 4.0
                    International
                    <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" class="flex"
                        src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1">
                    <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" class="flex"
                        src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1">
                </a>
            </p>
        </footer>
    </x-miscomponentes.tablas>
</x-app-layout>
