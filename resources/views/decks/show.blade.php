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
                <form hx-post="{{ route('decks.draw', $deck) }}" hx-swap="outerHTML" hx-target="#discard-pile">
                    @csrf

                    <button>Draw</button>
                </form>
                @fragment('fragments.decks.show.discard_pile')
                    <div class="pt-2" id="discard-pile">
                        <h3 class="text-xl font-medium">Discard pile</h3>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 pt-2 justify-center items-center">
                            @foreach ($deck->discardPile as $card)
                                <div
                                    class="flex flex-col gap-1 border-2 border-gray-300 bg-white p-2 rounded-lg justify-center items-center aspect-[63/88]">
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
