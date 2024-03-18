<div class="py-4">
	<div class="flex flex-col gap-5">
		<article class="bg-white pt-6 lg:pl-6 pb-[18px] lg:pr-[18px] rounded-lg flex flex-col gap-6">
			<div class="pl-6 lg:pl-0">
				<!-- outcomes -->
				<div class="flex flex-nowrap overflow-x-auto lg:grid lg:grid-cols-3 gap-2 pl-6 lg:pl-0">
					@foreach($datas as $data)
						<div 
							wire:click="bet('{{ $data['id'] }}', '{{ $data['title'] }}')"
							class="p-1.5 flex flex-col justify-between gap-10 w-[128px] lg:w-auto min-w-[128px] isolate relative overflow-hidden rounded-lg group/outcome">
							<div class="absolute inset-0 -z-[1]"
								style="
									@if($data['effect'])
										-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */filter: grayscale(100%);
									@endif
									"
								>
								<img
									class="object-cover h-full w-full"
									alt="{{ $data['title'] }}"
									title="{{ $data['title'] }}"
									src="{{ $data['image'] }}"
									sizes="144px"
									/>
								<div class="absolute inset-0 group-hover/outcome:bg-blue-1/50"></div>
							</div>
							<div class="bg-neutral-5 h-8 w-11 rounded-sm flex items-center justify-center text-white">
								<span>66%</span>
							</div>
							<p class="text-sm font-medium text-white leading-[1.1]">
								{{ $data['title'] }}
							</p>
						</div>
					@endforeach
				</div>
			</div>
			<div class="px-6 lg:px-0 flex items-center justify-between">
				<!-- Placeholder for interactive elements such as tooltips -->
			</div>
		</article>


		{{-- {{ $article->uuid }} --}}
        {{-- UUUU
			{{ ($this->betAction)(['article_uuid' => 'aaaaaaaaaaaaaaaaaa']) }}
		UUUUU --}}
        {{-- UUUU
			{{ ($this->betAction)(['article_uuid' => $article->uuid]) }}
		UUUUU --}}



		<button 
			class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
			type="button" 
			wire:loading.attr="disabled" 
			{{-- wire:click="mountAction('bet')(['article_uuid' => $article->uuid])" --}}
			{{-- wire:click="mountAction('bet', JSON.parse('{'article_uuid' => $article->uuid}'))" --}}

			wire:click="mountAction('bet', JSON.parse('{\u0022article_uuid\u0022:\u0022{{ $article->uuid }}\u0022}'))"

			>
			<span class="fi-btn-label">
				bet
			</span>
		</button>




        <x-filament-actions::modals />


	</div>
</div>
