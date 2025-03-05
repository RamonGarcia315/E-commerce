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
        'name' => 'Nový'
    ]
]">

	<div class="card">
		<form action="{{route('admin.families.store')}}" method="POST">
			@csrf

			<x-validation-errors class="mb-4"></x-validation-errors>
			
			<div class="mb-4">
				<x-label class="mb-2">
					Jmeno
				</x-label>
				<x-input class="w-full" placeholder="Zadejte název rodiny" name="name" value="{{old('name')}}"/>
			</div>

			<div class="flex justify-end">
				<x-button>Uložit</x-button>
			</div>
		</form>
	</div>

</x-admin-layout>
