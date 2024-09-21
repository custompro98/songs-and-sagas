<x-app-layout>
    <div class="flex flex-col gap-2 max-w-screen-lg mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Parties</h1>
            <form action="{{ route('parties.store') }}" method="POST" class="flex items-center">
                @csrf

                <input type="submit" value="Create"
                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900" />
            </form>
        </div>
        <div class="md:flex justify-center hidden">
            @include('partials.parties.table', [
                'parties' => $parties,
                'includeCreate' => true,
            ])
        </div>
        <div class="md:hidden">
            @include('partials.parties.list', ['parties' => $parties])
        </div>
    </div>
</x-app-layout>
