<div>
    {{-- {{ dddx($model->ratings) }} --}}
    @if(Auth::check())
        <ul>
            <livewire:article.ratings :article="$model" />
        </ul>
    @else
        devi essere loggato
    @endif

    {{-- <ul>
    @foreach($model->ratings as $rating)
        <li>{{ $rating->title }}</li>
    @endforeach
    </ul> --}}
</div>
