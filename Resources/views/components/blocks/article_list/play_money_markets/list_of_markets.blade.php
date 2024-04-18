<div class="py-4">
    <div>
        @if(count($articles))
            <div class="grid gap-5 md:grid-cols-2">
                @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article', ['articles' => $articles])
            </div>
        @else
            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.no_articles_found')
        @endif
    </div>
</div>
