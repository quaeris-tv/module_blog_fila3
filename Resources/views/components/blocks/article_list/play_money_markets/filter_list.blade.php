<<<<<<< HEAD
<ul class="flex items-center flex-wrap gap-1">
    <template x-for="filter in filters">
        <li>
            <button @click="currentFilter = filter"
                class="h-10 px-4 flex items-center justify-center border rounded-lg transition-colors duration-100 ease-out"
                :class="currentFilter === filter ? 'bg-blue-1 text-white border-blue-1 hover:bg-blue-5' : 'hover:bg-neutral-2 text-neutral-5 border-neutral-3' "
=======
<ul class="flex flex-wrap items-center gap-1">
    <template x-for="filter in filters">
        <li>
            <button @click="currentFilter = filter"
                class="px-4 py-2 text-sm font-semibold rounded"
                :class="currentFilter === filter ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-800'"
>>>>>>> origin/dev
                x-text="filter"></button>
        </li>
    </template>
</ul>