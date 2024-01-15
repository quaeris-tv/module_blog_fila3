<div>
    {{-- dddx($model->ratings) --}}
    WIP
    <ul>
    @foreach($model->ratings as $rating)
        <li>{{ $rating->title }}</li>
    @endforeach
    </ul>
</div>
