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
        'name' => 'Nový'
    ]
]">

	@livewire('admin.procducts.product-create')

</x-admin-layout>
