<div class="max-w-[calc(100%-30px)] sm:max-w-[calc(100%-80px)] lg:max-w-[996px] mx-auto pb-12">
<section class="pt-8" aria-label="Play Money Markets" x-data="playmarkets">
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
			x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
			class="relative">
			<button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
				type="button"
				class="flex items-center gap-2 hover:bg-white px-4 h-10 text-neutral-5 rounded-lg transition-colors duration-200 [&>svg]:aria-expanded:rotate-180">
				Order By
				<svg class="transition-transform duration-200" width="11px" height="7px" fillcolor="currentColor"
					viewBox="0 0 12 8" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M5.99999 4.97667L10.125 0.851669L11.3033 2.03L5.99999 7.33334L0.696655 2.03L1.87499 0.851669L5.99999 4.97667Z"
						fill="currentColor"></path>
				</svg>
			</button>
			<div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
				:id="$id('dropdown-button')" style="display: none"
				class="absolute right-0 mt-2.5 rounded-md bg-white shadow-md min-w-[270px]">
				<button type="button"
					class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md p-4 text-left text-sm hover:bg-blue-2 text-[#212121] transition-colors duration-75 ease-out whitespace-nowrap font-medium hover:text-blue-1">
				Recently created
				</button>
				<button type="button"
					class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md p-4 text-left text-sm hover:bg-blue-2 text-[#212121] transition-colors duration-75 ease-out whitespace-nowrap font-medium hover:text-blue-1">
				Coming Soon
				</button>
				<button type="button"
					class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md p-4 text-left text-sm hover:bg-blue-2 text-[#212121] transition-colors duration-75 ease-out whitespace-nowrap font-medium hover:text-blue-1">
				Number Of Bets
				</button>
				<button type="button"
					class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md p-4 text-left text-sm hover:bg-blue-2 text-[#212121] transition-colors duration-75 ease-out whitespace-nowrap font-medium hover:text-blue-1">
				Volume
				</button>
			</div>
		</div>
	</div>
	<!-- filterlist -->
	@include('pub_theme::layouts.home.play_money_markets.filter_list')


	<!-- list of markets -->
	@include('pub_theme::layouts.home.play_money_markets.list_of_markets')





	<div class="py-12 flex justify-center">
		<button type="button"
			class="max-w-[320px] w-[90%] bg-white px-10 h-14 rounded-lg text-blue-1 hover:text-[#0f79c8]">
		Load more
		</button>
	</div>
</section>
</div>