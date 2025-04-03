<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Hlavní obrázky',
    ],
]">

	<x-slot name="action">
		<a class="btn btn-blue" href="{{route('admin.covers.create')}}">
			Nový
		</a>
	</x-slot>

    <ul class="space-y-4" id="covers">
        @foreach ($covers as $cover)
        
            <li class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex cursor-move" data-id="{{$cover->id}}">

                <img src="{{$cover->image}}" alt="" class="w-full lg:w-64 aspect-[3/1] object-cover object-center">

                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-3 lg:space-y-0">

                    <div>
                        <h1 class="font-semibold">
                            {{$cover->title}}
                        </h1>

                        <p>
                            @if ($cover->is_active)
                                
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">
                                Aktivní
                            </span>

                            @else
                                
                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">
                                Neaktivní
                            </span>

                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold">
                            Datum zahájení
                        </p>

                        <p>
                            {{$cover->start_at->format('d/m/Y')}}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold">
                            Datum ukončení
                        </p>

                        <p>
                            {{$cover->end_at ? $cover->end_at->format('d/m/Y') : '-'}}
                        </p>
                    </div>

                    <div>
                        <a class="btn btn-blue" href="{{route('admin.covers.edit', $cover)}}">
                            Upravit
                        </a>
                    </div>

                </div>
            </li>

        @endforeach
    </ul>

    @push('js')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js"></script>

        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-blue-100',
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();

                        axios.post("{{route('api.sort.covers')}}", {
                            sorts: sorts
                        }).catch((error) => {
                            console.log(error);
                        });
                    }
                }
            });
        </script>
        
    @endpush

</x-admin-layout>
