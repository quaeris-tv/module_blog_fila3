<div class="relative" x-data="{ tooltip: false }">
    <button type="button" @mouseover="tooltip = true" @mouseleave="tooltip = false"
    @click="tooltip = !tooltip"
    class="flex items-center gap-1.5 p-1.5 hover:bg-[#d8e6f1] bg-transparent cursor-pointer rounded">
    <svg fill="none" width="16px" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M7 13.6667C6.21207 13.6667 5.43185 13.5115 4.7039 13.2099C3.97594 12.9084 3.31451 12.4665 2.75736 11.9093C2.2002 11.3522 1.75825 10.6907 1.45672 9.96276C1.15519 9.23481 0.999997 8.45459 0.999997 7.66666C0.999997 6.87873 1.15519 6.09852 1.45672 5.37056C1.75825 4.64261 2.2002 3.98117 2.75736 3.42402C3.31451 2.86687 3.97594 2.42491 4.7039 2.12339C5.43185 1.82186 6.21207 1.66666 7 1.66666C8.5913 1.66666 10.1174 2.2988 11.2426 3.42402C12.3679 4.54924 13 6.07536 13 7.66666C13 9.25796 12.3679 10.7841 11.2426 11.9093C10.1174 13.0345 8.5913 13.6667 7 13.6667ZM7 12.3333C7.61283 12.3333 8.21967 12.2126 8.78585 11.9781C9.35204 11.7436 9.86649 11.3998 10.2998 10.9665C10.7332 10.5332 11.0769 10.0187 11.3114 9.45252C11.546 8.88633 11.6667 8.2795 11.6667 7.66666C11.6667 7.05383 11.546 6.44699 11.3114 5.88081C11.0769 5.31462 10.7332 4.80017 10.2998 4.36683C9.86649 3.93349 9.35204 3.58975 8.78585 3.35522C8.21967 3.1207 7.61283 3 7 3C5.76232 3 4.57534 3.49166 3.70017 4.36683C2.825 5.242 2.33333 6.42899 2.33333 7.66666C2.33333 8.90434 2.825 10.0913 3.70017 10.9665C4.57534 11.8417 5.76232 12.3333 7 12.3333ZM7.66666 7.66666H9.66666V9H6.33333V4.33333H7.66666V7.66666ZM0.16333 3.18866L2.52066 0.831329L3.46333 1.774L1.10666 4.13133L0.163997 3.18866H0.16333ZM11.4767 0.831329L13.834 3.18866L12.8913 4.13133L10.534 1.774L11.4767 0.831329Z"
            fill="#292929"></path>
    </svg>
    <span x-text="formatDate(market.bet_end_date)" class="text-sm text-[#666666]"></span>
    </button>
    <!-- tooltip -->
    <div x-cloak x-show.transition.origin.top="tooltip"
        class="absolute z-10 inline-block w-max bottom-11 shadow-[0_2px_8px_0_#00000026] bg-white text-sm text-[#6b6a6a] rounded-lg">
        <div class="p-4 flex flex-col gap-2.5">
            <p class="text-black font-semibold text-sm leading-none">
                Bet end date
            </p>
            <p class="text-sm leading-none text-neutral-3 font-roboto whitespace-nowrap"
                x-text="formatDate(market.bet_end_date,{year: 'numeric', month:'long', day: 'numeric'})">
            </p>
        </div>
        <div
            class="absolute size-3 bg-inherit rotate-45 bottom-0 translate-y-1/2 left-12 border-b border-r border-[#00000026]">
        </div>
    </div>
</div>