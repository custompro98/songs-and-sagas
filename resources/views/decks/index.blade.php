<x-app-layout>
    <div class="flex flex-col gap-2 max-w-screen-lg mx-auto">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">Decks</h1>
            <x-primary-button>
                <a href="{{ route('decks.create') }}">
                    <span>Create</span>
                </a>
            </x-primary-button>
        </div>
        <div class="md:flex justify-center hidden">
            @include('partials.decks.table', [
                'decks' => $decks,
                'includeCreate' => true,
            ])
        </div>
        <div class="md:hidden">
            @include('partials.decks.list', ['decks' => $decks])
        </div>
    </div>
</x-app-layout>
