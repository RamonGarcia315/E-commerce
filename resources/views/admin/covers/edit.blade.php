<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Ovládací panel',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Hlavní obrázky',
        'route' => route('admin.covers.index'),
    ],
    [
        'name' => 'Editovat'
    ]
]">

    <div class="card">
        <form action="{{route('admin.covers.update', $cover)}}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            <figure class="relative mb-4">
                <div class="absolute top-8 right-8">
                    <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                        <i class="fas fa-camera mr-2"></i>
                        Aktualizovat obrázek

                        <input type="file" class="hidden" accept="image/*" name="image" onchange="previewImage(event, '#imgPreview')">
                    </label>
                </div>
                <img src="{{$cover->image}}" alt="Hlavní obrázky" class="w-full aspect[3/1] object-cover object-center" id="imgPreview">
            </figure>

            <x-validation-errors class="mb-4"></x-validation-errors>

            <div class="mb-4">

                <x-label>
                    Název
                </x-label>

                <x-input name="title" value="{{old('title', $cover->title)}}" class="w-full" placeholder="Prosím, zadejte název hlavní obrázek"/>

            </div>

            <div class="mb-4">

                <x-label>
                    Datum zahájení
                </x-label>

                <x-input type="date" name="start_at" value="{{old('start_at', $cover->start_at->format('Y-m-d'))}}" class="w-full"/>

            </div>

            <div class="mb-4">

                <x-label>
                    Datum ukončení (nepovinný)
                </x-label>

                <x-input type="date" name="end_at" value="{{old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-d') : '')}}" class="w-full"/>

            </div>

            <div class="mb-4 flex space-x-2">

                <label class="text-white">
                    <x-input type="radio" name="is_active" value="1" :checked="$cover->is_active == 1"/>
                    Aktivní
                </label>

                <label class="text-white">
                    <x-input type="radio" name="is_active" value="0" :checked="$cover->is_active == 0"/>
                    Neaktivní
                </label>

            </div>

            <div class="flex justify-end">
                <x-button>
                    Aktualizovat
                </x-button>
            </div>
            
        </form>
    </div>
    

    @push('js')

        <script>
            function previewImage(event, querySelector){

                let input = event.target;

                let imgPreview = document.querySelector(querySelector);

                if(!input.files.length) return

                let file = input.files[0];

                let objectURL = URL.createObjectURL(file);

                imgPreview.src = objectURL;
                        
            }
        </script>
        
    @endpush

</x-admin-layout>
