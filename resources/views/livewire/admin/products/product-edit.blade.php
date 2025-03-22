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
            <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt="">
        </figure>

        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="card">
            
            <div class="mb-4">
                <x-label class="mb-1">
                    Kód
                </x-label>
                
                <x-input wire:model="productEdit.sku" class="w-full" placeholder="Zadejte kód produktu"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Jmeno
                </x-label>
                
                <x-input wire:model="productEdit.name" class="w-full" placeholder="Zadejte nazev produktu"/>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Popis
                </x-label>
                
                <x-textarea wire:model="productEdit.description" class="w-full" placeholder="Zadejte popis produktu"></x-textarea>
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

                <x-select class="w-full" wire:model.live="productEdit.subcategory_id">
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

                <x-input type="number" step="0.01" wire:model="productEdit.price" class="w-full" placeholder="Zadejte cena produktu"/>
            </div>

            @empty($product->variants->count() > 0)
                <div class="mb-4">
                    <x-label class="mb-1">
                        Stock
                    </x-label>

                    <x-input type="number" wire:model="productEdit.stock" class="w-full" placeholder="Zadejte stock produktu"/>
                </div>
            @endempty

            
            
            <div class="flex justify-end">
                <x-danger-button onclick="confirmDelete()">Odstranit</x-danger-button>
                <x-button class="ml-2">
                    Aktualizovat
                </x-button>
            </div>
        </div>
    </form>
    <form action="{{route('admin.products.destroy', $product)}}" method="POST" id="delete-form">
		@csrf

		@method('DELETE')
	</form>

	@push('js')
		<script>
			function confirmDelete() {
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
							document.getElementById('delete-form').submit();
						}
						});
			}
		</script>
	@endpush
</div>
