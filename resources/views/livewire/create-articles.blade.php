<div>
    <div class="flex flex-row-reverse mx-6 my-auto">
        <button data-tooltip-target="tooltip-narticulo"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
            wire:click="$set('openCrear', true)" title="Crear Nuevo Artículo">
            <i class="fas fa-add"></i> <span class="max-sm:hidden"> Nuevo</span>
        </button>
        <div id="tooltip-narticulo" role="tooltip"
            class="max-sm:hidden absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Crear Nuevo Artículo
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Crear Artículo
        </x-slot>
        <x-slot name="content">
            @wire('defer')
                <x-form-input name="nombre" id="nombre" label="Nombre del artículo" />
                <x-form-textarea name="descripcion" id="descripcion" label="Descripción" />
                <x-form-group name="disponible" label="Artículo Disponible?" inline>
                    <x-form-radio name="disponible" value="SI" label="Si" />
                    <x-form-radio name="disponible" value="NO" label="No" />
                </x-form-group>
                <x-form-input name="precio" type="number" step="0.01" id="precio" label="Precio del artículo" />
                <x-form-input name="stock" type="number" step="1" id="stock"
                    label="Número de unidades (stock)" />
                <x-form-select name="category_id" :options="$categories" label="Categoría" />
                <x-form-select name="marca_id" :options="$marcas" label="Marca" />
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
