<div class="px-6 lg:px-0 flex items-center justify-between">
    <div class="flex items-center gap-4 lg:gap-8">
        <div class="relative" x-data="{ tooltip: false }">
            <button type="button"
            class="flex items-center gap-4 lg:gap-8 rounded p-1.5 hover:bg-[#d8e6f1] cursor-pointer"
            @mouseover="tooltip = true" @mouseleave="tooltip = false" @click="tooltip = !tooltip">
            <div class="flex items-center gap-1.5">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="question-card__person-icon" fill="#292929" width="13px">
                    <path fill-rule="evenodd"
                        d="M11.5 4C9.02 4 7 6.02 7 8.5S9.02 13 11.5 13 16 10.98 16 8.5 13.98 4 11.5 4M8.744 14.386A6.51 6.51 0 0 1 5 8.5C5 4.916 7.916 2 11.5 2S18 4.916 18 8.5a6.51 6.51 0 0 1-3.744 5.886C18.156 15.508 21 18.946 21 23h-2c0-3.97-3.309-7-7.5-7S4 19.03 4 23H2c0-4.055 2.845-7.492 6.744-8.614z">
                    </path>
                </svg>
                <span x-text="market.wagers_count_total" class="text-sm text-[#666666]"></span>
            </div>
            <div class="flex items-center gap-1.5">
                <svg viewBox="0 0 16 17" fillcolor="#292929" width="13px"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.5 9H3.83333V16.5H0.5V9ZM12.1667 5.66667H15.5V16.5H12.1667V5.66667ZM6.33333 0.666668H9.66667V16.5H6.33333V0.666668Z"
                        fill="#6B6A6A"></path>
                </svg>
                <span x-text="formatCurrency(market.volume_play_money)+' ø'"
                    class="text-sm text-[#666666]"></span>
            </div>
            </button>
            <!-- tooltip -->
            <div x-cloak x-show.transition.origin.top="tooltip"
                class="absolute z-10 inline-block w-[262px] bottom-11 shadow-[0_2px_8px_0_#00000026] bg-white text-sm text-[#6b6a6a] rounded-lg">
                <div class="p-4 flex flex-col gap-2.5">
                    <template x-if="market.wagers_count_total > 0">
                        <div>
                            <!-- forecasters -->
                            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.footer_info.forecasters')
                        </div>
                    </template>
                    <!-- volume -->
                    @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.footer_info.volume')
                </div>
                <div
                    class="absolute size-3 bg-inherit rotate-45 bottom-0 translate-y-1/2 left-12 border-b border-r border-[#00000026]">
                </div>
            </div>
        </div>
        <!-- bet end -->
        @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.footer_info.bet_end')
    </div>
    @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.footer_info.view_real_money')
</div>