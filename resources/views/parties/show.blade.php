<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $party->name }}</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 pt-4">
            <section>
                <h2 class="text-2xl font-medium">Details</h2>
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Name</span>
                        <span>{{ $party->name }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Description</span>
                        <span>{{ $party->description }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Join code</span>
                        <div class="flex flex-row gap-1 items-center">
                            <x-button-copy showText="{{ $party->join_code }}" copyText="{{ $party->join_code }}"
                                class="size-5 inline text-gray-500 hover:text-gray-600 active:text-gray-900" />
                        </div>
                    </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Members</h2>
                <div class="md:flex justify-center hidden pt-2">
                    @include('partials.characters.table', [
                        'characters' => $characters,
                        'includeCreate' => false,
                    ])
                </div>
                <div class="md:hidden">
                    @include('partials.characters.list', ['characters' => $characters])
                </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Tables</h2>
                <div class="pt-2">
                    <ul>
                        @if ($party->tables()->count() > 0)
                            @foreach ($party->tables()->get() as $table)
                                <li class="flex flex-row gap-1">
                                    <a href="{{ route('tables.show', $table->id) }}"
                                        class="underline text-blue-500">{{ $table->name }}</a>
                                </li>
                            @endforeach
                        @else
                            <li>No obligations...<em>yet</em>.</li>
                        @endif
                    </ul>
                    <form action="{{ route('table_parties.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="party_id" value="{{ $party->id }}" />
                        <input type="text" name="join_code" placeholder="QvD0Hx4GWc9CR4f3"
                            class="border border-black h-6 w-48 p-1" />
                        <input type="submit" value="Join" class="p-2" />
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
