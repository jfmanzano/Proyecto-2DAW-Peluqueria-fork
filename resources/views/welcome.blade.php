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
    </x-miscomponentes.tablas>
</x-app-layout>
