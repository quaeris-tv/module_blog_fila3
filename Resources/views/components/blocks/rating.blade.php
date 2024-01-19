<div>
    {{-- {{ dddx($model->ratings) }} --}}
    <ul>
        <livewire:article.ratings :article="$model" />
    </ul>

    {{-- <ul>
    @foreach($model->ratings as $rating)
        <li>{{ $rating->title }}</li>
    @endforeach
    </ul> --}}
</div>
