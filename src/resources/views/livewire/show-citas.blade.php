<x-miscomponentes.tablas>
    <main>
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
                <li class="flex items-center">Citas</li>
            </ol>
        </nav>
        <article class="flex flex-row-reverse mb-3">
            @livewire('create-citas')
        </article>
        @if ($citas->count())
        <!--En este caso meto un overflow a la tabla ya que es demasiado grande, ahora al hacer scroll
        en modo móvil se moverá la tabla sin afectar a toda la página-->
        <article style="overflow: auto">
            <table id="citas"
                class="display text-center dark:text-white border border-slate-700 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                style="width:100%">
                <thead>
                    <tr class="border border-slate-700 dark:border-slate-300">
                        <th class="border border-slate-700 dark:border-slate-300">Fecha y Hora</th>
                        <th class="border border-slate-700 dark:border-slate-300">Tipo</th>
                        <th class="border border-slate-700 dark:border-slate-300">Nombre</th>
                        <th class="border border-slate-700 dark:border-slate-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 border border-slate-700 dark:border-slate-300">
                                <!--En la base de datos la fecha la tengo guardada con una T
                                como separador, para que el usuario no vea la T me creo una variable
                                en la que guardo la T y con el str_replace la elimino
                                y pongo un espacio vacío-->
                                <?php
                                $letras = ['T'];
                                $item->fecha = str_replace($letras, ' ', $item->fecha);
                                ?>
                                {{ $item->fecha }}
                            </td>
                            <td class="py-4 border border-slate-700 dark:border-slate-300">
                                {{ $item->tipo }}
                            </td>
                            <td class="py-4 border border-slate-700 dark:border-slate-300">
                                {{ $item->user->name }}
                            </td>
                            <td class="py-4 border border-slate-700 dark:border-slate-300">
                                <span @class([
                                    'px-2 rounded-xl dark:bg-gray-500 bg-white
                                    dark:text-white border border-slate-700',
                                ])>
                                    <button data-tooltip-target="tooltip-borrarCita"
                                        wire:click="confirmar('{{ $item->id }}')" wire:loading.attr="disabled"
                                        title="Borrar Cita">
                                        <i class="fas fa-trash text-red-600"></i>
                                    </button>
                                    <div id="tooltip-borrarCita" role="tooltip"
                                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Borrar Cita
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <button data-tooltip-target="tooltip-editarCita"
                                        wire:click="editar('{{ $item->id }}')" wire:loading.attr="disabled"
                                        title="Editar Cita">
                                        <i class="fas fa-edit text-yellow-600"></i>
                                    </button>
                                    <div id="tooltip-editarCita" role="tooltip"
                                        class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Editar Cita
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
        @else
            <p class="font-bold italic text-red-600">No se encontró ninguna cita o no se ha creado ninguna</p>
        @endif
        <!--Modal para editar-->
        <x-dialog-modal wire:model="openEditar">
            <x-slot name="title">
                Editar Cita
            </x-slot>
            <x-slot name="content">
                @wire($miCita, 'defer')
                    <x-form-input type="datetime-local" name="miCita.fecha" min="{{ $fechaActual }}"
                        label="Fecha y hora de la cita (horario de 09:00 a 22:00)" />
                    <x-form-group name="miCita.tipo" label="Tipo de Cita" inline>
                        <x-form-radio name="miCita.tipo" value="Pelado" label="Pelado" />
                        <x-form-radio name="miCita.tipo" value="Lavado" label="Lavado" />
                        <x-form-radio name="miCita.tipo" value="Tinte" label="Tinte" />
                        <x-form-radio name="miCita.tipo" value="Peinado" label="Peinado" />
                    </x-form-group>
                @endwire
            </x-slot>
            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        wire:click="cerrar()">
                        <i class="fas fa-xmark mr-2"></i>Cancelar
                    </button>
                    <button class="mr-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                        wire:click="update" wire:loading.attr="disabled">
                        <i class="fas fa-save mr-2"></i>Editar
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </main>
    <!--Realizo el script del Datatable-->
    <script>
        $(document).ready(function() {
            var table = $('#citas').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
</x-miscomponentes.tablas>
