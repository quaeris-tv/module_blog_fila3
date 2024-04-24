<div class="py-8 mt-8 bg-white">
	@php
		if(!isset($method)){
			$articles = $_theme->getArticlesByCategory($category->id);
		}else{
			$mappedMethods = [
				'recent' => 'getArticlesLatest',
				'coming_soon' => 'getArticlesComingSoon',
				'bets' => 'getArticlesOrderByNumberOfBets',
				'volume' => 'getArticlesOrderByVolumes',
			];
			$query = request()->query('order', 'recent');
			$page = request()->query('page', 1);
			if (!in_array($query, array_keys($mappedMethods))) {
				$query = 'recent';
			}
			$articles = $_theme->getMethodData($mappedMethods[$query], ($page * 6));
		}
		// dddx($articles);
	@endphp
	<div class="container max-w-6xl p-6 mx-auto space-y-8" {{-- x-data="playmarkets" --}} id="playmarkets">
		<h2 class="flex items-center space-x-2 text-xl font-semibold">
			<x-heroicon-o-play-circle class="text-blue-500 size-8"/>
			<div class="flex flex-wrap gap-x-2">
				<span>
					@if(isset($title))
						{{ $title }}
					@else
						Articoli della categoria
					@endif
				
				
				</span>
				<span class="mt-1 text-sm font-normal text-gray-500">{{ count($articles) }}</span>
			</div>
		</h2>
		<section class="space-y-4">
			<div class="flex flex-wrap justify-between gap-2 gap-4 lg:items-center">
				{{-- @include('blog::components.blocks.article_list.play_money_markets.filter_list') --}}
				@include('blog::components.blocks.article_list.play_money_markets.order_select')
			</div>
			@include('blog::components.blocks.article_list.play_money_markets.list_of_markets')
			<div class="flex justify-center">
				<a href="{{ url()->current().'?'.http_build_query(array_merge(request()->query(), ['page' => $page + 1])) }}" class="flex items-center px-4 py-2 space-x-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
					<span>Load more</span>
					<x-heroicon-o-arrow-right class="size-4"/>
				</a>
			</div>
		</section>
	</div>
</div>
