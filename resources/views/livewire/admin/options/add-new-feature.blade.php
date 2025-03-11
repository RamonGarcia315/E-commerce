<div>

    <form wire:submit="addFeature" class="flex space-x-4">

        <div class="flex-1">
            <x-label class="mb-1">
                Hodnota
            </x-label>

            @switch($option->type)
                @case(1)
                    <x-input wire:model="newFeature.value" class="w-full"
                        placeholder="Zadejte hodnotu možnosti" />
                @break

                @case(2)
                    <div class="border border-gray-500 rounded-md h-[42px] flex items-center justify-between px-3 text-gray-400">
                        {{ $newFeature['value'] ?: 'Vyberte barvu' }}

                        <input type="color" class="bg-gray-800" wire:model.live="newFeature.value">
                    </div>
                @break

                @default
            @endswitch
        </div>

        <div class="flex-1">
            <x-label class="mb-1">
                Popis
            </x-label>

            <x-input wire:model="newFeature.description" class="w-full" placeholder="Zadejte popis" />
        </div>
        <div class="pt-7">
            <x-button>
                Přidat
            </x-button>
        </div>

    </form>

</div>
