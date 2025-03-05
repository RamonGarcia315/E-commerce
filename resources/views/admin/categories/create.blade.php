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
        'name' => 'Nový'
    ]
]">

	<div class="card">
		<form action="{{route('admin.categories.store')}}" method="POST">
			@csrf

			<x-validation-errors class="mb-4"></x-validation-errors>

			<div class="mb-4">
				<x-label class="mb-2">
					Rodina
				</x-label>

				<x-select name="family_id" class="w-full">
					@foreach ($families as $family)
						<option value="{{$family->id}}" @selected(old('family_id') == $family->id)>
							{{$family->name}}
						</option>
					@endforeach
				</x-select>
			</div>

			<div class="mb-4">
				<x-label class="mb-2">
					Jmeno
				</x-label>
				<x-input class="w-full" placeholder="Zadejte název kategorie" name="name" value="{{old('name')}}"/>
			</div>

			<div class="flex justify-end">
				<x-button>Uložit</x-button>
			</div>
		</form>
	</div>

</x-admin-layout>
