<x-app-layout>
    <div class="flex flex-col gap-4 md:gap-2 max-w-screen-lg mx-auto">
        <h1 class="text-3xl font-bold">Characters</h1>
        <div class="md:flex justify-center hidden">
            @include('partials.characters.table', [
                'characters' => $characters,
                'includeCreate' => true,
            ])
        </div>
        <div class="md:hidden">
            @include('partials.characters.list', ['characters' => $characters])
        </div>
    </div>
</x-app-layout>
