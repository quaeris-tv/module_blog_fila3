<div class="container max-w-6xl p-6 mx-auto space-y-4">
    <h2 class="flex items-center space-x-2 text-xl font-semibold">
        <x-heroicon-o-fire class="text-blue-500 size-8"/>
        <span>Hot Topics</span>
    </h2>
    <section aria-label="Hot topics">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach([1, 2, 3] as $o)
            <a class="bg-white rounded-lg overflow-clip" href="/q/category/103/world-politics">
                <div class="h-[240px] relative">
                    <img class="absolute inset-0 object-cover w-full h-full" src="https://placehold.co/600x400" alt=""/>
                </div>
                <div class="flex flex-col justify-between p-4 space-y-2">
                    <span class="inline px-3 py-1 text-blue-600 rounded w-max bg-blue-200/20">{{ fake()->numberBetween(10, 100) }} markets</span>
                    <h3 class="font-semibold grow">{{ fake()->sentence() }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
</div>
