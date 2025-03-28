<div>

    <form wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                    <i class="fas fa-camera mr-2"></i>
                    Aktualizovat obrázek

                    <input type="file" class="hidden" accept="image/*" wire:model="image">
                </label>
            </div>
            <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $image ? $image->temporaryUrl() : asset('img/no-image.png') }}" alt="">
        </figure>

        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="card">
            
            <div class="mb-4">
                <x-label class="mb-1">
                    Kód
                </x-label>
                
                <x-input wire:model="product.sku" class="w-full" placeholder="Zadejte kód produktu"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Jmeno
                </x-label>
                
                <x-input wire:model="product.name" class="w-full" placeholder="Zadejte nazev produktu"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Popis
                </x-label>
                
                <x-textarea wire:model="product.description" class="w-full" placeholder="Zadejte popis produktu"></x-textarea>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Rodina
                </x-label>
                
                <x-select class="w-full" wire:model.live="family_id">
                    <option value="" disabled>Vyberte rodinu</option>
                    @foreach ($families as $family)
                        <option value="{{$family->id}}">
                            {{$family->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Kategorie
                </x-label>

                <x-select class="w-full" wire:model.live="category_id">
                    <option value="" disabled>Vyberte kategorie</option>
                    @foreach ($this->categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Podkategorie
                </x-label>

                <x-select class="w-full" wire:model.live="product.subcategory_id">
                    <option value="" disabled>Vyberte podkategorie</option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">
                            {{$subcategory->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Cena
                </x-label>

                <x-input type="number" step="0.01" wire:model="product.price" class="w-full" placeholder="Zadejte cena produktu"/>
            </div>
            
            <div class="flex justify-end">
                <x-button>
                    Vytvořit produkt
                </x-button>
            </div>

        </div>
    </form>
</div>
