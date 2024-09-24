<x-app-layout>
    <div class="flex flex-col gap-4 md:gap-2 max-w-screen-lg mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Characters</h1>
            <button
                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                <a href="{{ route('characters.create') }}">
                    <span>Create</span>
                </a>
            </button>
        </div>
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
