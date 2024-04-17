<div class="flex flex-col gap-4" {{-- x-show="!isloggedIn" --}}>
    <div class="block w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full flex py-3 px-3 justify-between bg-blue-1 text-white font-bold" style="color:white">
            Your bet
        </div>
        @include('blog::livewire.article.ratings.for-image.v1.guest.login_register')

    </div>
    {{-- @include('blog::livewire.article.ratings.for-image.v1.guest.other') --}}
</div>