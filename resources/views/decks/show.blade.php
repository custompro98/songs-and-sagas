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

            <section x-data="{ showModal: false, selectedCard: null }">
                <h2 class="text-2xl font-medium">Table</h2>
                <div class="flex flex-row gap-2 pt-2">
                    <form hx-post="{{ route('decks.draw', $deck) }}" hx-swap="outerHTML" hx-target="#discard-pile">
                        @csrf

                        <x-primary-button>Draw</x-primary-button>
                    </form>
                    <form action="{{ route('decks.recall', $deck) }}" method="POST">
                        @csrf

                        <x-primary-button>Recall</x-primary-button>
                    </form>
                    <form action="{{ route('decks.shuffle', $deck) }}" method="POST">
                        @csrf

                        <x-primary-button>Shuffle</x-primary-button>
                    </form>
                </div>
                @fragment('fragments.decks.show.discard_pile')
                    <div class="pt-2" id="discard-pile">
                        <h3 class="text-xl font-medium">Discard pile</h3>
                        <div
                            class="grid gap-4 grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:gap-0 lg:grid-cols-1 pt-2 isolate">
                            @foreach ($deck->discardPile()->limit(9)->get() as $card)
                                <div class="flex flex-col gap-1 border-2 border-gray-300 bg-white shadow p-2 rounded-lg justify-center items-center aspect-[63/88] max-w-40 lg:col-start-1 lg:row-start-1 lg:translate-x-[{{ 6 * $loop->index }}rem] lg:z-[-{{ $loop->index }}] lg:hover:z-[100] lg:hover:translate-y-[-1rem] lg:translate-x-[{{ 6 * $loop->index }}rem] lg:transition-all lg:ease-in-ease-out lg:duration-300 cursor-pointer"
                                    x-on:click="selectedCard = {{ $card->id }}; $dispatch('open-modal', 'send-to-hand-{{ $card->id }}')">
                                    <span>{{ $card->rank }}</span>
                                    <span>of</span>
                                    <span>{{ $card->suit }}</span>
                                </div>
                                <x-modal name="send-to-hand-{{ $card->id }}" focusable>
                                    <div class="flex flex-col gap-4">
                                        <div class="border-b border-gray-100 bg-white p-4">
                                            <h3 class="text-xl font-medium">Send to character</h3>
                                        </div>
                                        <form method="POST" action="{{ route('cards.send', $card->id) }}"
                                            class="p-6 flex flex-col gap-4">
                                            @csrf
                                            @method('patch')

                                            <div class="flex flex-col gap-1">
                                                <label for="send-card-character-id"
                                                    class="text-sm font-medium text-gray-900">
                                                    Character
                                                </label>
                                                <select name="character_id" id="send-card-character-id">
                                                    <option value="">-</option>
                                                    @foreach ($characters as $character)
                                                        <option value="{{ $character->id }}">
                                                            {{ $character->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <x-primary-button class="max-w-fit">Send</x-primary-button>
                                        </form>
                                    </div>
                                </x-modal>
                            @endforeach
                        </div>
                    </div>
                @endfragment
            </section>
        </div>
    </div>
</x-app-layout>
