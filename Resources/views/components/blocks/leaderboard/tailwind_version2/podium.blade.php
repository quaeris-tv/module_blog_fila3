<a
href="#"
class="flex max-lg:gap-4 max-lg:py-2 lg:flex-col lg:items-center text-neutral-5 hover:text-[#1e70bf]"
>
<div
    class="lg:contents relative flex justify-center max-lg:h-max"
    >
    <img
        {{-- src="https://futuur-media-production.s3.amazonaws.com/cache/b1/81/b1816fa03b437898ec58f5ea571c4d4a.jpg" --}}
        src="{{ $profile->getAvatarUrl() }}"
        class="size-10 
            @if($loop->iteration == 2)
                lg:size-[7.5rem] 
            @else
                lg:size-20 
            @endif
            rounded-full shrink-0 object-cover"
        alt="{{ $profile->full_name }}"
        />
    <span
        class="bg-[#fce0be] text-[#8e4e00] py-1.5 px-4 max-lg:absolute max-lg:-bottom-4 lg:-mt-4 rounded-full text-xs leading-none"
        >{{ $loop->iteration }}nd</span
        >
</div>
<div class="flex flex-col lg:contents">
    <span class="mb-2 lg:mt-6 text-base lg:text-xl font-semibold"
        >{{ $profile->full_name }}</span
        >
    <span class="text-base leading-none">{{ $profile->credits }}</span>
</div>
</a>