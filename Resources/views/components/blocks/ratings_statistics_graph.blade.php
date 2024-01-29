<div>
    {{-- {{ dddx(get_defined_vars()) }} --}}
    {{-- {{ dddx($model->getOptionRatings()->toArray()->pluck('title')) }} --}}
    graph wip

    <livewire:article-chart :type_chart="$block['data']['chart_type']" :article_id="$model->id"/>


</div>
