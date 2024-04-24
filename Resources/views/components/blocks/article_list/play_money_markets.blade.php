<div class="py-8 mt-8 bg-white">
	@php
		if(!isset($method)){
			$articles = $_theme->paginateArticlesByCategory($category->id);
		}else{
			$mappedMethods = [
				'recent' => 'paginatedArticlesLatest',
				'coming_soon' => 'paginatedArticlesComingSoon',
				'bets' => 'paginatedArticlesOrderByNumberOfBets',
				'volume' => 'paginatedArticlesOrderByVolumes',
			];
			$query = request()->query('order', 'recent');
			if (!in_array($query, array_keys($mappedMethods))) {
				$query = 'recent';
			}
			dddx([
				$mappedMethods[$query],
				$method
			]);
			$articles = $_theme->getMethodData($mappedMethods[$query]);
		}
	@endphp
	<div class="container max-w-6xl p-6 mx-auto space-y-8" {{-- x-data="playmarkets" --}} id="playmarkets">
		<h2 class="flex items-center space-x-2 text-xl font-semibold">
			<x-heroicon-o-play-circle class="text-blue-500 size-8"/>
			<div class="flex flex-wrap gap-x-2">
				<span>
					@if(isset($title))
						{{ $title }}
					@else
						{{-- Articoli della categoria --}}
						{{ __('blog::category.show.title') }} "{{ $category->title }}"
						{{-- <span class="mt-1 text-sm font-normal text-gray-500">{{ $articles->total() }}</span> --}}
					@endif
			</div>
		</h2>
		<section class="space-y-4">
			<div class="flex flex-wrap justify-between gap-2 gap-4 lg:items-center">
				{{-- @include('blog::components.blocks.article_list.play_money_markets.filter_list') --}}
				@include('blog::components.blocks.article_list.play_money_markets.order_select')
			</div>
			@include('blog::components.blocks.article_list.play_money_markets.list_of_markets')
			<div>
				{{ $articles->links() }}
			</div>
		</section>
	</div>
</div>
