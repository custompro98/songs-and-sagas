<x-app-layout>
    <div class="flex flex-col gap-4 md:gap-2 max-w-screen-lg mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Characters</h1>
            <x-primary-button>
                <a href="{{ route('characters.create') }}">
                    <span>Create</span>
                </a>
            </x-primary-button>
        </div>
        <div class="lg:flex justify-center hidden">
            @include('partials.characters.table', [
                'characters' => $characters,
                'includeCreate' => true,
            ])
        </div>
        <div class="lg:hidden">
            @include('partials.characters.list', ['characters' => $characters])
        </div>
    </div>
</x-app-layout>
