<div class="py-4">
    @php
        $articles = $_theme->getMethodData($method);

    @endphp

    <template x-if="isOneCol">
        <div class="flex flex-col gap-5">

            @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article', ['articles' => $articles])
        </div>
    </template>
    <template x-if="!isOneCol">
        <div class="grid grid-cols-2 gap-5">

            {{-- <div class="flex flex-col gap-5"> --}}
                @include('blog::components.blocks.article_list.play_money_markets.list_of_markets.article', ['articles' => $articles])
            {{-- </div> --}}
            {{-- <div class="flex flex-col gap-5">
                @include('pub_theme::layouts.home.play_money_markets.list_of_markets.article')
            </div> --}}
        </div>
    </template>
</div>
