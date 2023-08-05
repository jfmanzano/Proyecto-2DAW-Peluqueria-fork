<div>
    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
    wire:click="$set('openCrear', true)">
        <i class="fas fa-add"></i> Nuevo
    </button>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear Categoría
        </x-slot>
        <x-slot name="content">
            @wire('defer')
            <x-form-input name="nombre" id="nombre" label="Nombre de la categoría" />
            <x-form-input name="color" id="color" type="color" label="Color" />
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
