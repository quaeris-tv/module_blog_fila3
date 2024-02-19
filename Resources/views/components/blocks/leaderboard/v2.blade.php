@props([
    'tpl',
    'version' => 'v1',
    'title' => $block['data']['title']
])

<!-- Leader Board Starts -->
<div class="row">
    <h2 class="text-center leader-title mb40 wow fadeInDown" style="font-size: 40px;">{{ $title }}</h2>
</div>
<div class="row gape">
    <div class="col-xl-6">
        @include('blog::components.blocks.leaderboard.v2.top_users_volume')
    </div>
    <div class="col-xl-6">
        @include('blog::components.blocks.leaderboard.v2.top_users_profit')
    </div>
</div>
<!-- Leader Board Ends -->