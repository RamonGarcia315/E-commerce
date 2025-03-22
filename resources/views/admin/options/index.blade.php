<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Možnosti',
    ],
]">

	@livewire('admin.options.manage-options')

</x-admin-layout>
