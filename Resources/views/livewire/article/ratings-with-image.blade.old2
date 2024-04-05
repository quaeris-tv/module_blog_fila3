<div class="py-4">
	<div class="flex flex-col gap-5">
		<article class="bg-white p-6 lg:p-[18px] rounded-lg flex flex-col">
			<div>
				<!-- outcomes -->
				<div class="flex gap-2 flex-nowrap lg:grid lg:grid-cols-3">
					@foreach($datas as $data)
						<button wire:click="bet('{{ $data['id'] }}', '{{ $data['title'] }}')" class="relative block w-full overflow-hidden rounded-lg aspect-[4/3] {{ $rating_title == $data['title'] ? 'border-[3px] border-blue-600 shadow-lg shadow-blue-300' : '' }}">
							<div class="absolute inset-0 z-10 grid pointer-events-none place-items-center">
								<x-filament::loading-indicator class="w-5 h-5" wire:loading wire:target="bet('{{ $data['id'] }}', '{{ $data['title'] }}')"/>
							</div>
							<div class="absolute inset-0">
								<img class="object-cover aspect-[4/3]" alt="{{ $data['title'] }}" title="{{ $data['title'] }}" src="{{ $data['image'] }}" />
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
			@php
			/*
			{{-- {{ $article->uuid }} --}}
			{{-- UUUU
				{{ ($this->betAction)(['article_uuid' => 'aaaaaaaaaaaaaaaaaa']) }}
			UUUUU --}}
			{{-- UUUU
				{{ ($this->betAction)(['article_uuid' => $article->uuid]) }}
			UUUUU --}}

			{{-- UUUU
				{{ ($this->betAction) }}
			UUUUU --}}


			{{-- {{ $article_uuid }} --}}


			<button
				class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
				type="button"
				wire:loading.attr="disabled"
				{{-- :wire:key="$article->title" --}}
				{{-- wire:click="mountAction('bet')(['article_uuid' => $article->uuid])" --}}
				{{-- wire:click="mountAction('bet', JSON.parse('{'article_uuid' => $article->uuid}'))" --}}

				{{-- wire:click="mountAction('bet', JSON.parse('{\u0022article_uuid\u0022:\u0022{{ $article->uuid }}\u0022}'))" --}}
				{{-- wire:click="mountAction('bet', JSON.parse('{\u0022article_uuid\u0022:\u0022{{ $article->uuid }}\u0022}'))" --}}
				wire:click="mountAction('bet', ['{{ $article_uuid }}'])"

				>
				<span class="fi-btn-label">
					bet
				</span>
			</button>


			*/
			@endphp
			<x-filament-actions::modals />
		@endif
	</div>
</div>
