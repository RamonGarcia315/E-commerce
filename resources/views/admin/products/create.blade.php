<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Produkty',
		'route' => route('admin.products.index'),
    ],
	[
        'name' => 'Nový'
    ]
]">

	@livewire('admin.products.product-create')

</x-admin-layout>
