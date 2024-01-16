<div>
    {{-- {{ dddx($model->ratings) }} --}}
    WIP
    <ul>
        <livewire:article.vote-rating :article="$model" />
    </ul>

    {{-- <ul>
    @foreach($model->ratings as $rating)
        <li>{{ $rating->title }}</li>
    @endforeach
    </ul> --}}
</div>
