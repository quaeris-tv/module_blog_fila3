<div>
    vote rating
    @if(Auth::check())
        <ul>
            @foreach($ratings_options as $rating)
            {{-- {{ dddx($rating) }} --}}
                <li>
<<<<<<< HEAD
                    <button type="button"
=======
                    <button type="button" 
>>>>>>> 6223082 (wip VoteRating.php)
                        wire:click="vote({{ $rating }})"
                        {{-- wire:confirm="Are you sure you want to delete this post?" --}}
                        >
                        {{ $rating->title }}
                    </button>
                </li>
            @endforeach
        </ul>
    @else
        devi essere loggato per votare
    @endif
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> 6223082 (wip VoteRating.php)
