<div>
    vote rating
    <ul>
        @foreach($article->ratings as $rating)
        {{-- {{ dddx($rating) }} --}}
            <li>
                <button type="button" 
                    wire:click="vote({{ $rating }})"
                    {{-- wire:confirm="Are you sure you want to delete this post?" --}}
                    >
                    {{ $rating->title }}
                </button>
            </li>
        @endforeach
    </ul>
</div>