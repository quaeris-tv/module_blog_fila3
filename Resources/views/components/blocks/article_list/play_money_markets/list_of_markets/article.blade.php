{{-- {{ dddx($articles) }} --}}
@foreach($articles as $article)
    <article class="bg-white pt-6 lg:pl-6 pb-[18px] lg:pr-[18px] rounded-lg flex flex-col gap-6">
        <div class="pl-6 lg:pl-0">

            {{-- <template x-if="Boolean(market.event_start_date)"> --}}
                <div class="text-blue-1 flex items-center gap-2 text-sm font-medium">
                    <svg width="8px" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="4" cy="4" r="4" fill="currentColor"></circle>
                    </svg>
                    In 16 hours and 05 minutes
                </div>
            {{-- </template> --}}
            {{-- <a :href="'#'+market.slug" x-text="market.title" --}}
            <a href="{{ $article->url('show') }}"
                class="mt-1 sm:max-w-[310px] text-xl font-semibold text-neutral-4 block">
                {{ $article->title }}
            </a>
            <!-- categories -->
            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.categories')
        </div>
        <!-- outcomes -->
        {{-- questa blade è uguale a Blog\Resources\views\livewire\article\ratings-with-image\rating_with_image.blade.php --}}
        @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article.outcomes', ['datas' => $article->ratings])
        @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article.footer_info')
    </article>
@endforeach