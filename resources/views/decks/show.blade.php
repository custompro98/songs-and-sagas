<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $deck->name }}</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 pt-4">
            <section>
                <h2 class="text-2xl font-medium">Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Name</span>
                        <span>{{ $deck->name }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Description</span>
                        <span>{{ $deck->description }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Cards in deck</span>
                        <span>{{ $deck->drawPile()->count() }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Cards in discard</span>
                        <span>{{ $deck->discardPile()->count() }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Cards in hands</span>
                        <span>{{ $deck->handPile()->count() }}</span>
                    </div>
            </section>

            <section>
                <h2 class="text-2xl font-medium">Table</h2>
                <form hx-post="{{ route('decks.draw', $deck) }}" hx-swap="outerHTML" hx-target="#discard-pile"
                    class="pt-2">
                    @csrf

                    <button
                        class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                        Draw
                    </button>
                </form>
                @fragment('fragments.decks.show.discard_pile')
                    <div class="pt-2" id="discard-pile">
                        <h3 class="text-xl font-medium">Discard pile</h3>
                        <div class="grid grid-cols-1 pt-2 isolate">
                            @foreach ($deck->discardPile()->limit(9)->get() as $card)
                                <div class="flex flex-col gap-1 border-2 border-gray-300 bg-white shadow p-2 rounded-lg justify-center items-center aspect-[63/88] max-w-40 col-start-1 row-start-1 translate-x-[{{ 6 * $loop->index }}rem] z-[-{{ $loop->index }}] hover:z-[100] hover:translate-y-[-1rem] translate-x-[{{ 6 * $loop->index }}rem] transition-all ease-in-ease-out duration-300"
                                    <span>{{ $card->rank }}</span>
                                    <span>of</span>
                                    <span>{{ $card->suit }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endfragment
            </section>
        </div>
    </div>
</x-app-layout>
