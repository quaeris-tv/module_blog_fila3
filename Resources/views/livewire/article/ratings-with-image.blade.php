<div class="py-4">
	<div class="flex flex-col gap-5">
		<article class="bg-white rounded-lg flex flex-col xot-modal-place-bet {{ $dense ? '' : 'p-6 lg:p-[18px]' }}">
			<div>
				<!-- outcomes -->
				<div class="flex gap-2 flex-nowrap lg:grid lg:grid-cols-3">
					@foreach($datas as $data)
						<button wire:click="bet('{{ $data['id'] }}', '{{ $data['title'] }}')" class="relative block w-full overflow-hidden rounded-lg aspect-[4/3] {{ $rating_title == $data['title'] ? 'border-[3px] border-blue-600 shadow-lg shadow-blue-300' : '' }}">
							<div class="absolute inset-0 z-10 grid pointer-events-none place-items-center">
								<x-filament::loading-indicator class="w-5 h-5" wire:loading wire:target="bet('{{ $data['id'] }}', '{{ $data['title'] }}')"/>
							</div>
							<div class="absolute inset-0">
								<img class="absolute inset-0 object-cover w-full h-full" alt="{{ $data['title'] }}" title="{{ $data['title'] }}" src="{{ $data['image'] }}" />
								<div class="absolute inset-0 transition bg-transparent hover:bg-blue-500/30"></div>
							</div>
							<div class="p-1.5 absolute inset-0 flex flex-col text-start justify-between pointer-events-none">
								<div class="flex items-center justify-center h-8 rounded-sm bg-neutral-5 w-11 {{ strlen($rating_title) && $rating_title != $data['title'] ? 'text-gray-400' : 'text-white'}}">
									<span>{{ $ratings_percentage[$data['id']] }}%</span>
								</div>
								<p class="text-sm font-medium text-white leading-[1.1] ">
									{{ $data['title'] }}
								</p>
							</div>
						</button>
					@endforeach
				</div>
			</div>
			<div class="flex items-center justify-between px-6 lg:px-0">
				<!-- Placeholder for interactive elements such as tooltips -->
			</div>
		</article>

		@if($type == 'index')
			<x-filament-actions::modals />
		@endif
	</div>
</div>
