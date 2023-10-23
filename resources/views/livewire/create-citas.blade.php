<div>
    <div class="flex flex-row-reverse mx-6 my-auto">
        <button data-tooltip-target="tooltip-ncita"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
            wire:click="$set('openCrear', true)" title="Crear Nueva Cita">
            <i class="fas fa-add"></i> <span class="max-sm:hidden"> Nueva</span>
        </button>
        <div id="tooltip-ncita" role="tooltip"
            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Crear Nueva Cita
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear Cita
        </x-slot>
        <x-slot name="content">
            @wire('defer')
                <x-form-input type="datetime-local" name="fecha" id="fecha" min="{{ $fechaActual }}"
                    label="Fecha y hora de la cita" />
                <x-form-group name="tipo" label="Tipo de Cita" inline>
                    <x-form-radio name="tipo" value="Pelado" label="Pelado" />
                    <x-form-radio name="tipo" value="Lavado" label="Lavado" />
                    <x-form-radio name="tipo" value="Tinte" label="Tinte" />
                    <x-form-radio name="tipo" value="Peinado" label="Peinado" />
                </x-form-group>
            @endwire
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="cerrar()">
                    <i class="fas fa-xmark mr-2"></i>Cancelar
                </button>
                <button class="mr-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="guardar()" wire:loading.attr="disabled">
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
