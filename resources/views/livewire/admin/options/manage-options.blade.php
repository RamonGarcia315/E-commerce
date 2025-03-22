<div>

    <section class="rounded-lg bg-gray-800 shadow-lg">

        <header class="border-b border-gray-600 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-white">
                    Možnosti
                </h1>

                <x-button wire:click="$set('newOption.openModal', true)">Nový</x-button>
            </div>
        </header>

        <div class="p-6">

            <div class="space-y-6">

                @foreach ($options as $option)
                    
                <div class="p-6 rounded-lg border border-gray-600 relative" wire:key="option-{{$option->id}}">

                    <div class="absolute -top-3 px-4 bg-gray-800">

                        <button class="mr-1" onclick="confirmDelete({{$option->id}}, 'option')">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                        </button>

                        <span class="text-white">
                            {{ $option->name }}
                        </span>
                    </div>

                    <div class="flex flex-wrap mb-4">
                        
                        @foreach ($option->features as $feature)
                            
                            @switch($option->type)
                                @case(1)
                                    
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                                    {{$feature->description}}

                                    <button class="ml-0.5" onclick="confirmDelete({{$feature->id}}, 'feature')">
                                        <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                    </button>
                                </span>

                                    @break
                                @case(2)
                                    
                                    <div class="relative">
                                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-500 mr-4" style="background-color: {{ $feature->value }}"></span>

                                        <button class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-600 h-4 w-4 flex justify-center items-center" onclick="confirmDelete({{$feature->id}}, 'feature')">
                                            <i class="fa-solid fa-xmark text-white text-xs"></i>
                                        </button>
                                    </div>

                                    @break
                                @default
                                    
                            @endswitch

                        @endforeach

                    </div>

                    <div>
                        @livewire('admin.options.add-new-feature', ['option' => $option], key('add-new-feature-' . $option->id))
                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>

    <x-dialog-modal wire:model="newOption.openModal">

        <x-slot name="title">
            Vytvořit novou možnost
        </x-slot>

        <x-slot name="content">

            <x-validation-errors class="mb-4"></x-validation-errors>

            <div class="grid grid-cols-2 gap-6 mb-4">

                <div>
                    <x-label class="mb-1">
                        Jmeno
                    </x-label>

                    <x-input wire:model="newOption.name" class="w-full" placeholder="Například: Velikost, Barva, atd..." />
                </div>
                <div>
                    <x-label class="mb-1">
                        Typ
                    </x-label>

                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Text</option>
                        <option value="2">Barva</option>
                    </x-select>
                </div>

            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">

                <span class="mx-4">
                    Hodnoty
                </span>

                <hr class="flex-1">
            </div>
            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)

                    <div class="p-6 rounded-lg border border-gray-600 relative" wire:key="features-{{$index}}">

                        <div class="absolute -top-3 px-4 bg-gray-800">
                            <button wire:click="removeFeature({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-6">

                            <div>
                                <x-label class="mb-1">
                                    Hodnota
                                </x-label>
            
                                @switch($newOption->type)
                                    @case(1)
                                        <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full" placeholder="Zadejte hodnotu možnosti" />
                                        @break
                                    @case(2)
                                        <div class="border border-gray-500 rounded-md h-[42px] flex items-center justify-between px-3">
                                            {{
                                                $newOption->features[$index]['value'] ?: "Vyberte barvu"
                                            }}

                                            <input type="color" class="bg-gray-800" wire:model.live="newOption.features.{{ $index }}.value">
                                        </div>
                                        @break
                                    @default
                                        
                                @endswitch
                            </div>

                            <div>
                                <x-label class="mb-1">
                                    Popis
                                </x-label>
            
                                <x-input wire:model="newOption.features.{{ $index }}.description" class="w-full" placeholder="Zadejte popis" />
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

            <div class="flex justify-end">

                <x-button wire:click="addFeature">
                    Přidat hodnotu
                </x-button>

            </div>

        </x-slot>

        <x-slot name="footer">

            <button class="btn btn-blue" wire:click="addOption">
                Přidat
            </button>

        </x-slot>

    </x-dialog-modal>

    @push('js')
		<script>
			function confirmDelete(id, type) {
				Swal.fire({
						title: "Jste si jistý?",
						text: "Tuto akci nelze vrátit zpět!",
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "Ano, smazat!",
						cancelButtonText: "Zrušit"
						}).then((result) => {
						if (result.isConfirmed) {
                            switch (type) {
                                case 'feature':
                                    @this.call('deleteFeature', id)
                                    break;
                            
                                case 'option':
                                    @this.call('deleteOption', id)
                                    break;
                            }

							
						}
						});
			}
		</script>
	@endpush

</div>
