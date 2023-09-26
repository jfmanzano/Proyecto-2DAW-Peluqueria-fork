<div>
    <div class="flex flex-row-reverse mx-6 my-auto">
        <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
            wire:click="$set('openCrear', true)" title="Crear Nueva Marca">
            <i class="fas fa-add"></i> Nueva
        </button>
    </div>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear Marca
        </x-slot>
        <x-slot name="content">
            @wire('defer')
                <x-form-input name="nombre" id="nombre" label="Nombre de la marca" />
                <x-form-textarea name="descripcion" id="descripcion" label="Descripción" />
            @endwire
            <div class="mt-2 relative">
                @if ($imagen)
                    <button wire:click="$set('imagen')"
                        class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cambiar Imagen</button>
                    <img class="object-center object-cover border-lg" src="{{ $imagen->temporaryUrl() }}" />
                @else
                    <div class="flex h-32 rounded-xl px-2 py-4 justify-center items-center bg-gray-200">
                        <label for="imgCrear"
                            class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">Imagen</label>
                    </div>
                @endif
                <input id="imgCrear" type="file" name="imagen" wire:model="imagen" accept="image/*"
                    class="hidden" />
                @error('imagen')
                    <p class="text-xs text-red-500 mt-2 italic">{{ $message }}</p>
                @enderror
            </div>
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
