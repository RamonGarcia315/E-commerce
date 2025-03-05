<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Kategorie',
		'route' => route('admin.categories.index'),
    ],
	[
        'name' => $category->name
    ]
]">

	<div class="card">
		<form action="{{route('admin.categories.update', $category)}}" method="POST">
			@csrf

			@method('PUT')

			<x-validation-errors class="mb-4"></x-validation-errors>

			<div class="mb-4">
				<x-label class="mb-2">
					Rodina
				</x-label>

				<x-select name="family_id" class="w-full">
					@foreach ($families as $family)
						<option value="{{$family->id}}" @selected(old('family_id', $category->family_id) == $family->id)>
							{{$family->name}}
						</option>
					@endforeach
				</x-select>
			</div>

			<div class="mb-4">
				<x-label class="mb-2">
					Jmeno
				</x-label>
				<x-input class="w-full" placeholder="Zadejte název kategorie" name="name" value="{{old('name', $category->name)}}"/>
			</div>

			<div class="flex justify-end">
				<x-danger-button onclick="confirmDelete()">Odstranit</x-danger-button>

				<x-button class="ml-2">Aktualizovat</x-button>
			</div>
		</form>
	</div>

	<form action="{{route('admin.categories.destroy', $category)}}" method="POST" id="delete-form">
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

</x-admin-layout>
