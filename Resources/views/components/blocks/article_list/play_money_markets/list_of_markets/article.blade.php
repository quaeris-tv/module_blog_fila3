{{-- @foreach(collect(->toArray())->split(2) as $_articles) --}}
    <div class="gap-5 sm:columns-2" style="gap: 1rem; counter-reset: grid;">
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
                            @if($article->time_left_for_humans == 'expired')
                                {{ __('blog::article.single_expired') }}
                            @else
                                {{-- In 16 hours and 05 minutes --}}
                                {{ $article->time_left_for_humans }}
                            @endif
                        </div>
                    @endif
                {{-- </template> --}}
                {{-- <a :href="'#'+market.slug" x-text="market.title" --}}
                <a href="
                    {{ route('article.view', ['lang'=>$lang,'slug' => $article->slug ]) }}
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
            
            {{-- <livewire:article.ratings-with-image type="index" :ratings="$article->ratings" :wire:key="$article->uuid" :article_uuid="$article->uuid"/> --}}
            {{-- {{ dddx($article->ratings) }} --}}
            <livewire:article.ratings-with-image 
                type="index" 
                :ratings="$article->ratings" 
                :wire:key="$article->uuid" 
                :article_uuid="$article->uuid"
                {{-- :article="$article" --}}
                />

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
                <livewire:article.ratings-done :article_uuid="$article->uuid" :article_data="$article->toArray()" wire:key="$article->uuid"/>

                @livewire(\Modules\Predict\Http\Livewire\Widgets\RatingsDoneWidget::class, ['article_data' => $article->toArray(), 'user_id' => $_user->id])
            @endif
        </article>
    @endforeach
    </div>
{{-- @endforeach --}}
