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
        'name' => $product->name
    ]
]">

	@livewire('admin.products.product-edit', ['product' => $product])

</x-admin-layout>
