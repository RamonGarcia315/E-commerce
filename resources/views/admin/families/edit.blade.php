<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Rodiny',
		'route' => route('admin.families.index'),
    ],
	[
        'name' => $family->name,
    ]
]">

	<div class="card">
		<form action="{{route('admin.families.update', $family)}}" method="POST">
			@csrf

			@method('PUT')

			<div class="mb-4">
				<x-label class="mb-2">
					Jmeno
				</x-label>
				<x-input class="w-full" placeholder="Zadejte název rodiny" name="name" value="{{old('name', $family->name)}}"/>
			</div>

			<div class="flex justify-end">
				<x-danger-button onclick="confirmDelete()">Odstranit</x-danger-button>
				<x-button class="ml-2">Aktualizovat</x-button>
			</div>
		</form>
	</div>

	<form action="{{route('admin.families.destroy', $family)}}" method="POST" id="delete-form">
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
