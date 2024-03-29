<div>
    @if(Auth::check())
        <div
            {{-- x-show="loggedIn" --}}
            x-cloak
            class="bg-white rounded-2xl text-sm space-y-10 p-6"
            >
            <div class="flex items-center gap-4">
                <div
                    class="size-[75px] bg-neutral-2 flex items-center justify-center rounded-full text-2xl text-white"
                    >
                    U
                </div>
                <p class="text-base font-semibold text-neutral-5">username</p>
            </div>
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <p class="text-neutral-3 text-sm font-medium font-roboto">
                        Forecaster rank
                    </p>
                    <span class="text-sm text-neutral-4 font-semibold">#</span>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-neutral-3 text-sm font-medium font-roboto">
                        Lifetime profit
                    </p>
                    <p class="text-sm">
                        <span class="text-neutral-4 font-semibold">0.00</span>
                        <span class="text-neutral-3 font-medium">Ooms</span>
                    </p>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="text-sm font-semibold text-blue-6"
                    >Go to my profile</a
                    >
            </div>
        </div>
    @else
        <div
            {{-- x-show="!loggedIn" --}}
            x-cloak
            class="bg-white rounded-2xl text-sm space-y-10 p-6"
            >
            <p class="text-base font-semibold">
                Sign up or login to participate
            </p>
            <div class="flex gap-4">
                <button
                    type="button"
                    class="border border-blue-6 font-semibold hover:bg-blue-6 hover:text-white text-blue-6 focus:ring-4 focus:outline-none focus:ring-blue rounded-lg text-sm px-10 h-10 flex items-center justify-center text-center"
                    >
                Sign Up
                </button>
                <button
                    type="button"
                    class="bg-blue-6 text-white hover:bg-[#061989] focus:ring-4 focus:outline-none focus:ring-blue font-semibold rounded-lg text-sm px-10 h-10 flex items-center justify-center text-center"
                    >
                Login
                </button>
            </div>
        </div>
    @endif
</div>