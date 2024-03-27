@props(['page_id', 'text'])

@if ($page = \Modules\Blog\Models\Page::find($page_id))
    <a
        class="aspect-[4/3] p-4 border bg-gray-100"
        href="{{ $this->url('show',['record'=>$page]) }}"
    >
        {{ $text ?: $page->title }}
    </a>
@endif
