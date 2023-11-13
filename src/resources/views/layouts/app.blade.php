<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Proyecto Peluquerias Dbarb" />
    <meta name="keywords" content="html,css,javascript,bootstrap,tailwind,php,laravel" />
    <meta name="author" content="Daniel Calatrava González" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Google fonts: -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap&effect=neon" rel="stylesheet">
    <!--CDN FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CDN Flowbite-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <!-- CDN Datatables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- Script Flowbite-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <!-- Sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-silver">
    <x-banner />

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <footer class="text-center">
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/">
                <a data-tooltip-target="tooltip-proyecto" property="dct:title" rel="cc:attributionURL"
                    href="https://github.com/dancg/Proyecto-2DAW-Peluqueria" class="hover:text-blue-700 text-blue-900"
                    target="_blank">Peluquerias
                    Dbarb</a> by 
            <div id="tooltip-proyecto" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Ver Proyecto en GitHub
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <a data-tooltip-target="tooltip-autor" rel="cc:attributionURL dct:creator" property="cc:attributionName"
                href="https://github.com/dancg" class="hover:text-blue-700 text-blue-900" target="_blank"> Daniel
                Calatrava González</a>
            <div id="tooltip-autor" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Ver Perfil Autor en GitHub
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            is licensed under <a data-tooltip-target="tooltip-creativecommons"
                class="flex flex-wrap justify-center items-center hover:text-blue-700 text-blue-900"
                href="http://creativecommons.org/licenses/by/4.0/?ref=chooser-v1" target="_blank"
                rel="license noopener noreferrer"> Attribution 4.0
                International
                <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" class="flex"
                    src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1">
                <img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" class="flex"
                    src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1">
            </a>
            <div id="tooltip-creativecommons" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Ver Licencias en Creative Commons
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            </p>
            <div class="h-6"></div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
    <!--Función javascript para mostrar alertas con sweetalert2-->
    <script>
        Livewire.on('mensaje', txt => {
            Swal.fire({
                icon: 'success',
                title: txt,
                showConfirmButton: false,
                timer: 1500
            })
        })
        
        //Alerta de Categorías
        Livewire.on('permisoBorrar', categoryId => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('show-categories', 'borrarCategory', categoryId)
                // Esta parte es necesaria para que mantenga la forma del datatable, ya que si
                // no está puesto se deforma la tabla y habría que recargar la página para arreglarlo.
                }else {
                    var cancelar = document.createElement("a");
                    cancelar.href = "{{route('categorias.show')}}";
                    cancelar.click();
                }
            })
        })

        //Alerta de Marcas
        Livewire.on('permisoBorrar2', marcaId => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('show-marcas', 'borrarMarca', marcaId)
                }
            })
        })

        //Alerta de Artículos
        Livewire.on('permisoBorrar3', articleId => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('show-articles', 'borrarArticulo', articleId)
                }
            })
        })

        //Alerta de Citas
        Livewire.on('permisoBorrar4', citaId => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('show-citas', 'borrarCita', citaId)
                // Esta parte es necesaria para que mantenga la forma del datatable, ya que si
                // no está puesto se deforma la tabla y habría que recargar la página para arreglarlo.
                }else {
                    var cancelar = document.createElement("a");
                    cancelar.href = "{{route('citas.show')}}";
                    cancelar.click();
                }
            })
        })

        //Alerta de Controladores
        @if (session('info'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 1500
            })
        @endif
    </script>
</body>

</html>
