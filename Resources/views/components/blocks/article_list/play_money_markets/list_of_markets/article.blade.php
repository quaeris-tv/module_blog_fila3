{{-- @foreach(collect(->toArray())->split(2) as $_articles) --}}
    <div class="gap-5" style="column-count: 2; gap: 1rem; counter-reset: grid;">
    @foreach($articles as $article)
        @php
            $article = $_theme->mapArticle($article);
        @endphp
        <article class="bg-white pt-6 lg:pl-6 pb-[18px] lg:pr-[18px] rounded-lg flex flex-col gap-6 border rounded mb-5" style="break-inside: avoid;">
            <div class="pl-6 lg:pl-0">

                {{-- <template x-if="Boolean(market.event_start_date)"> --}}
                    @if($article->time_left_for_humans != null)
                        <div class="flex items-center gap-2 text-sm font-medium text-blue-1">
                            <svg width="8px" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="4" cy="4" r="4" fill="currentColor"></circle>
                            </svg>
                            {{-- In 16 hours and 05 minutes --}}
                            {{ $article->time_left_for_humans }}
                        </div>
                    @endif
                {{-- </template> --}}
                {{-- <a :href="'#'+market.slug" x-text="market.title" --}}
                <a href="
                    {{ route('article_slug.show', ['lang'=>$lang,'article_slug' => $article->slug ]) }}
                    {{-- {{ $article->url('show') }} --}}
                    {{-- url('articles/'.$article->slug) --}}
                    "
                    class="mt-1 sm:max-w-[310px] text-xl font-semibold text-neutral-4 block">
                    {{ $article->title }}
                </a>
                <!-- categories -->
                @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.categories')
            </div>


            <!-- outcomes -->
            {{-- questa blade è uguale a Blog\Resources\views\livewire\article\ratings-with-image\rating_with_image.blade.php --}}
            {{-- @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article.outcomes', ['datas' => $article->ratings]) --}}
            <livewire:article.ratings-with-image type="index" :ratings="$article->ratings" :wire:key="$article->uuid" :article_uuid="$article->uuid"/>

            @if($article->tags->count())
                <div class="flex flex-wrap gap-1">
                    @foreach($article->tags as $tag)
                        <a href="javascript:;" class="px-2 py-1 text-sm transition rounded hover:bg-gray-100 bg-gray-50">
                            #<span class="text-gray-500">{{ $tag }}</span>
                        </a>
                    @endforeach
                </div>
            @endif

            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article.footer_info')

            {{-- @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article.ratings') --}}
            @if(Auth::check())
                @php
                    $art = $article->toArray();
                @endphp
                <livewire:article.ratings-done :article_uuid="$article->uuid" :article_data="$art" wire:key="$article->uuid"/>
            @endif
        </article>
    @endforeach
    </div>
{{-- @endforeach --}}