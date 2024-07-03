<div class="pt-4">
<<<<<<< HEAD
    <ul class="flex items-center flex-wrap">
        @foreach($article->categories as $category)
            <li class="flex items-center">
                @if($loop->index > 0)
                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 15" width="5px">
=======
    <ul class="flex flex-wrap items-center">
        @foreach($article->categories as $category)
            <li class="flex items-center gap-2">
                @if($loop->index > 0)
                    <svg class="ms-2" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 15" width="5px">
>>>>>>> origin/dev
                        <path d="M.175 1.238L1.399 0 9 7.523 1.397 15l-1.22-1.242L6.52 7.52.175 1.24z"
                            fill="currentColor"></path>
                    </svg>
                @endif
<<<<<<< HEAD
                <a href="#"
                    @if($loop->index + 1 == $article->categories->count())
                        class="p-2 rounded-lg text-base leading-4 hover:bg-neutral-2 font-bold"
                    @else
                        class="p-2 rounded-lg text-base leading-4 hover:bg-neutral-2"
=======
                <a href="
                    {{-- {{ url('categories/'.$category->slug) }} --}}
                    {{ route('category_slug.show', ['lang'=>$lang,'category_slug' => $category->slug ]) }}
                    "
                    @if($loop->index + 1 == $article->categories->count())
                        class="text-base font-bold leading-4 rounded-lg hover:text-blue-1"
                    @else
                        class="text-base leading-4 rounded-lg hover:text-blue-1"
>>>>>>> origin/dev
                    @endif
                    >
                    {{ $category->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>