<div class="max-w-[calc(100%-30px)] sm:max-w-[calc(100%-80px)] lg:max-w-[996px] mx-auto pb-12">
	<section class="pt-8" aria-label="Play Money Markets" x-data="playmarkets" id="playmarkets">
		<div class="flex justify-between items-center gap-4">
			<div class="flex items-center gap-4">
				<p class="text-neutral-5 text-base font-semibold">
					Play Money Markets
				</p>
				<span class="text-sm text-neutral-3" x-text="markets.length+' Markets'"></span>
			</div>
			<!-- order list -->
			@include('blog::components.blocks.article_list.play_money_markets.order_select')

		</div>
		<!-- filterlist -->
		{{-- @include('blog::components.blocks.article_list.play_money_markets.filter_list') --}}

		<!-- list of markets -->

		@include('blog::components.blocks.article_list.play_money_markets.list_of_markets')

		<div class="py-12 flex justify-center">
			<button type="button"
				class="max-w-[320px] w-[90%] bg-white px-10 h-14 rounded-lg text-blue-1 hover:text-[#0f79c8]">
			Load more
			</button>
		</div>
	</section>
</div>
