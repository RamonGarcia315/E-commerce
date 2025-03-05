<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Podkategorie',
		'route' => route('admin.subcategories.index'),
    ],
	[
        'name' => $subcategory->name
    ]
]">

	@livewire('admin.subcategories.subcategory-edit', compact('subcategory'))

</x-admin-layout>
