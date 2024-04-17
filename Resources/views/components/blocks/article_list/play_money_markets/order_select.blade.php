<div x-data="{
    open: false,
    toggle() {
    if (this.open) {
    return this.close()
    }
    this.$refs.button.focus()
    this.open = true
    },
    close(focusAfter) {
    if (! this.open) return
    this.open = false
    focusAfter && focusAfter.focus()
    }
    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
    {{-- x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" --}}
    class="relative">
    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
        type="button"
        class="flex items-center px-4 py-2 space-x-2 text-sm font-semibold rounded ring-1 ring-gray-300">
        <span class="text-nowrap">Order By</span>
        <x-heroicon-o-chevron-down class="transition-transform duration-200 size-4"/>
    </button>
    <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
        :id="$id('dropdown-button')"
        class="absolute right-0 mt-2.5 space-y-1 rounded bg-white border border-gray-200 backdrop-blur min-w-[270px] p-2">
        <button type="button" class="block w-full p-2 text-sm font-semibold rounded hover:bg-gray-100 text-start">
            Recently created
        </button>
        <button type="button" class="block w-full p-2 text-sm font-semibold rounded hover:bg-gray-100 text-start">
            Coming Soon
        </button>
        <button type="button" class="block w-full p-2 text-sm font-semibold rounded hover:bg-gray-100 text-start">
            Number Of Bets
        </button>
        <button type="button" class="block w-full p-2 text-sm font-semibold rounded hover:bg-gray-100 text-start">
            Volume
        </button>
    </div>
</div>