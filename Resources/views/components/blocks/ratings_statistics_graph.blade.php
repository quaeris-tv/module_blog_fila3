<div>
    {{-- {{ dddx(get_defined_vars()) }} --}}
    {{-- {{ dddx($model->getOptionRatingsIdTitle()) }} --}}
    graph wip

    <livewire:article-chart :type_chart="$block['data']['chart_type']" :article_id="$model->id" :optionsRatingsIdTitle="$model->getOptionRatingsIdTitle()"/>


</div>
