<div class="card">
    <form wire:submit="save">

        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="mb-4">
            <x-label class="mb-2">
                Rodina
            </x-label>

            <x-select class="w-full" wire:model.live="subcategoryEdit.family_id">
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

            

            <x-select class="w-full" wire:model.live="subcategoryEdit.category_id">
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
            <x-input class="w-full" placeholder="Zadejte název kategorie" wire:model="subcategoryEdit.name"/>
        </div>

        <div class="flex justify-end">
            <x-danger-button onclick="confirmDelete()">Odstranit</x-danger-button>
            <x-button class="ml-2">Aktualizovat</x-button>
        </div>
    </form>

    <form action="{{route('admin.subcategories.destroy', $subcategory)}}" method="POST" id="delete-form">
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
