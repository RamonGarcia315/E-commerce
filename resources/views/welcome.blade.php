<x-app-layout>
    
	@push('css')
		<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
		/>
	@endpush

	<!-- Slider main container -->
	<div class="swiper mb-12">
		<!-- Additional required wrapper -->
		<div class="swiper-wrapper">
			<!-- Slides -->
			@foreach ($covers as $cover)
				<div class="swiper-slide">
					<img src="{{$cover->image}}" class="w-full aspect-[3/1] object-cover object-center" alt="">
				</div>
			@endforeach
		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>
	
		<!-- If we need navigation buttons -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>

	<x-container>
		<h1 class="text-2xl font-bold text-gray-300">
			Nejnovější produkty
		</h1>

		<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
			
			@foreach ($lastProducts as $product)

				<article class="bg-white shadow rounded overflow-hidden">
					<img src="{{$product->image}}" class="w-full h-48 object-cover object-center">

					<div class="p-4">
						<h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] mb-2">
							{{$product->name}}
						</h1>

						<p class="text-gray-600 mb-4">
							{{$product->price}} Kč
						</p>

						<a href="" class="btn btn-blue block w-full text-center">
							Zobrazit více
						</a>
					</div>
				</article>
				
			@endforeach

		</div>
	</x-container>

	@push('js')
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	
	<script>
		const swiper = new Swiper('.swiper', {
			// Optional parameters
			loop: true,

			autoplay: {
				delay: 8000,
			},

			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
			},

			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	</script>

	@endpush
</x-app-layout>