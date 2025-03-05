<div class="card">
		<form wire:submit="save">

			<x-validation-errors class="mb-4"></x-validation-errors>

            <div class="mb-4">
				<x-label class="mb-2">
					Rodina
				</x-label>

				<x-select class="w-full" wire:model.live="subcategory.family_id">
                    <option value="" disabled>Vyberte rodinu</option>

                    @foreach ($families as $family)
						<option value="{{$family->id}}">
							{{$family->name}}
						</option>
					@endforeach
				</x-select>
			</div>
            
			<div class="mb-4">
				<x-label class="mb-2">
					Kategorie
				</x-label>

                

				<x-select class="w-full" wire:model.live="subcategory.category_id">
					<option value="" disabled>Vyberte kategorie</option>
                    @foreach ($this->categories as $category)
						<option value="{{$category->id}}">
							{{$category->name}}
						</option>
					@endforeach
				</x-select>
			</div>

			<div class="mb-4">
				<x-label class="mb-2">
					Jmeno
				</x-label>
				<x-input class="w-full" placeholder="Zadejte název kategorie" wire:model="subcategory.name"/>
			</div>

			<div class="flex justify-end">
				<x-button>Uložit</x-button>
			</div>
		</form>
</div>
