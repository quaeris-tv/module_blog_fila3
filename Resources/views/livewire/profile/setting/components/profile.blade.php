<section class="space-y-12">
    <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
        <div class="relative grid w-20 h-20 bg-gray-200 rounded-full place-items-center overflow-clip">
            {{-- <x-heroicon-o-user class="w-8 h-8 text-gray-400"/> --}}
            <img class="absolute object-cover w-full h-full text-gray-400" src="{{ $_profile?->getAvatarUrl() ?? 'https://placehold.co/200x200' }}" alt="">
        </div>
		<div class="space-y-2 text-center grow sm:text-left">
			<h2 class="text-2xl">{{ $_profile->user->name }}</h2>
            {{-- <div class="flex space-x-4">
                <div>0 <small class="text-sm text-gray-500">Followers</small></div>
                <div>0 <small class="text-sm text-gray-500">Following</small></div>
            </div> --}}
		</div>
        <div class="flex flex-wrap gap-2">
            <button wire:click="editProfile" class="flex items-center px-3 py-2 space-x-2 text-sm font-semibold transition rounded-lg text-nowrap ring-1 ring-gray-200 bg-gray-50 ring-inset hover:bg-gray-100 hover:no-underline">
                <x-heroicon-o-pencil class="size-4"/>
                <x-filament::loading-indicator class="w-5 h-5" wire:loading wire:target="editProfile"/>
                <span>Edit</span>
            </button>
            {{-- <a href="#" class="flex items-center px-3 py-2 space-x-2 text-sm font-semibold transition rounded-lg text-nowrap ring-1 ring-gray-200 bg-gray-50 ring-inset hover:bg-gray-100 hover:no-underline">
                <x-heroicon-o-power class="text-red-500 size-4"/>
                <span>Logout</span>
            </a> --}}
        </div>
	</div>
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center p-4 space-x-4 border rounded-xl">
            <x-heroicon-o-arrows-up-down class="text-blue-500 size-8"/>
            <div>
                <div class="text-gray-500">Market traded</div>
                <h2 class="text-4xl font-bold">
                    14
                    {{-- {{ dddx($_profile->getArticleTraded()) }} --}}
                </h2>
            </div>
        </div>
        <div class="flex items-center p-4 space-x-4 border rounded-xl">
            <x-heroicon-o-receipt-percent class="text-blue-500 size-8"/>
            <div>
                <div class="text-gray-500">Win Rate</div>
                <h2 class="text-4xl font-bold">83.5%</h2>
            </div>
        </div>
        <div class="flex items-center p-4 space-x-4 border rounded-xl">
            <x-heroicon-o-arrow-trending-up class="text-blue-500 size-8"/>
            <div>
                <div class="text-gray-500">Lifetime L/P</div>
                <h2 class="text-4xl font-bold">4K <span class="text-3xl font-medium text-gray-400">ø</span></h2>
            </div>
        </div>
        {{-- <div class="flex items-center p-4 space-x-4 border rounded-xl">
            <x-heroicon-o-wallet class="text-blue-500 size-8"/>
            <div>
                <div class="text-gray-500">Open Position</div>
                <h2 class="text-4xl font-bold">2</h2>
            </div>
        </div> --}}
    </div>
    {{-- <div>
        <h6 class="mb-2 text-xs text-gray-400">OPEN POSITIONS</h6>
        <div class="py-2 overflow-x-auto">
            <table class="w-full" cellpadding="12">
                <thead>
                    <tr class="text-sm text-gray-400 bg-gray-50">
                        <th class="text-start">Date</th>
                        <th>Action</th>
                        <th class="text-start">Market</th>
                        <th>Outcome</th>
                        <th>Av. Share Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7">
                            <div class="py-2 text-center">
                                <x-heroicon-o-x-circle class="inline-block text-blue-200 size-16"/>
                                <div>There are no open positions.</div>
                                <p class="text-sm text-gray-500">Vitae doloribus aut adipisci, neque iusto soluta eius velit. <a href="/" class="text-blue-500">Click here</a> to view market</p>
                            </div>   
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}

    <div>
        <h6 class="mb-2 text-xs text-gray-400">TRANSACTIONS <span class="text-blue-400">({{$_profile->ratingMorphs->count()}})</span></h6>
        <div class="py-2">
            <table class="w-full" cellpadding="12">
                <thead>
                    <tr class="text-sm text-gray-400 bg-gray-50">
                        <th class="text-start">Date</th>
                        <th>Action</th>
                        <th class="text-start">Market</th>
                        <th>Outcome</th>
                        <th>Av. Share Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($_profile->ratingMorphs->load('model', 'rating') as $morph)
                        <tr>
                            <td>{{ $morph->created_at }}</td>
                            <td class="text-center">{{ $morph->rating->title }}</td>
                            <td><a href="{{ url("/{$lang}/articles/{$morph->model->slug}") }}" target="_blank" class="text-blue-500">{{ $morph->model->title }}</a></td>
                            <td class="text-center">{{ $morph->value }}</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td>2024-04-15</td>
                        <td class="text-center">
                            <span class="px-3 py-1 text-sm font-semibold text-blue-500 rounded-full bg-blue-50">Bet</span>
                        </td>
                        <td>
                            <a href="#">Lorem ipsum dolor sit, amet consectetur adipisicing elit?</a>
                        </td>
                        <td class="text-center">No</td>
                        <td class="text-center">~.95</td>
                        <td class="text-center">2 ø</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>


    <x-filament-actions::modals />

</section>