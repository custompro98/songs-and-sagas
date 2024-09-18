<x-app-layout>
    <div class="flex flex-col gap-2 max-w-screen-lg mx-auto">
        <h1 class="text-3xl font-bold">Parties</h1>
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
