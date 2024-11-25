<x-filament-panels::page>
    <x-filament-panels::form
         wire:submit="save"
         >
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
        />

        <x-filament::button color="danger" wire:click="save" class="inline-flex justify-center rounded-md border border-transparent bg-green-700 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2">
            Add Rating
        </x-filament::button>

        {{-- <x-filament::button label="Scommetti" wire:click="save"></x-filament::button>

        <button
            type="submit"
            class="inline-flex justify-center rounded-md border border-transparent bg-green-700 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2"
            {{ $attributes }}
        >
            aaaa
        </button> --}}

    </x-filament-panels::form>
</x-filament-panels::page>
