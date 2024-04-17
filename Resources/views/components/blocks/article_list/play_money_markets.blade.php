<div class="max-w-[calc(100%-30px)] sm:max-w-[calc(100%-80px)] lg:max-w-[996px] mx-auto pb-12">
<<<<<<< HEAD
	<section class="pt-8" aria-label="Play Money Markets" x-data="playmarkets">
=======
	<section class="pt-8" aria-label="Play Money Markets" x-data="playmarkets" id="playmarkets">
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
		<div class="flex justify-between items-center gap-4">
			<div class="flex items-center gap-4">
				<p class="text-neutral-5 text-base font-semibold">
					Play Money Markets
				</p>
				<span class="text-sm text-neutral-3" x-text="markets.length+' Markets'"></span>
			</div>
			<div x-data="{
				open: false,
				toggle() {
				if (this.open) {
				return this.close()
				}
				this.$refs.button.focus()
				this.open = true
				},
				close(focusAfter) {
				if (! this.open) return
				this.open = false
				focusAfter && focusAfter.focus()
				}
				}" x-on:keydown.escape.prevent.stop="close($refs.button)"
<<<<<<< HEAD
				x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
				class="relative">

				<!-- order select -->
				{{-- @include('pub_theme::layouts.home.play_money_markets.order_select') --}}
			</div>
		</div>
		<!-- filterlist -->
		@include('pub_theme::layouts.home.play_money_markets.filter_list')

		<!-- list of markets -->
		@include('pub_theme::layouts.home.play_money_markets.list_of_markets')
=======
				{{-- x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" --}}
				class="relative">

				<!-- order select -->
				@include('pub_theme::layouts.home.play_money_markets.order_select')
			</div>
		</div>
		<!-- filterlist -->
		@include('blog::components.blocks.article_list.play_money_markets.filter_list')

		<!-- list of markets -->

		@include('blog::components.blocks.article_list.play_money_markets.list_of_markets')
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083

		<div class="py-12 flex justify-center">
			<button type="button"
				class="max-w-[320px] w-[90%] bg-white px-10 h-14 rounded-lg text-blue-1 hover:text-[#0f79c8]">
			Load more
			</button>
		</div>
	</section>
</div>
