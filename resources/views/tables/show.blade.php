<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $table->name }}</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 pt-4">
            <section>
                <h2 class="text-2xl font-medium">Details</h2>
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Name</span>
                        <span>{{ $table->name }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Party</span>
                        @if ($party)
                            <span>{{ $party->name }}</span>
                        @else
                            <span>No heroes <em>yet</em>.</span>
                        @endif
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Join code</span>
                        <div class="flex flex-row gap-1 items-center">
                            <x-button-copy showText="{{ $table->join_code }}" copyText="{{ $table->join_code }}"
                                class="size-5 inline text-gray-500 hover:text-gray-600 active:text-gray-900" />
                        </div>
                    </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Characters</h2>
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
                <h2 class="text-2xl font-medium">Deck</h2>
                @if ($deck)
                    <a href="{{ route('decks.show', $deck->id) }}" class="underline text-blue-500">
                        {{ $deck->name }}
                    </a>
                @else
                    <form action="{{ route('table_decks.store') }}" method="POST" class="flex flex-col gap-2">
                        @csrf

                        <input type="hidden" name="table_id" value="{{ $table->id }}">
                        <select name="deck_id" id="deck_id">
                            <option value="">-</option>
                            @foreach ($decks as $deck)
                                <option value="{{ $deck->id }}">
                                    {{ $deck->name }}
                                </option>
                            @endforeach
                        </select>

                        <button
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 max-w-fit">
                            <span>Set</span>
                        </button>
                    </form>
                @endif

                <div class="flex flex-row gap-2 pt-2">
                    <form hx-post="{{ route('decks.draw', $deck) }}" hx-swap="outerHTML" hx-target="#discard-pile">
                        @csrf

                        <button
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                            Draw
                        </button>
                    </form>
                    <form action="{{ route('decks.recall', $deck) }}" method="POST">
                        @csrf

                        <button
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                            Recall
                        </button>
                    </form>
                    <form action="{{ route('decks.shuffle', $deck) }}" method="POST">
                        @csrf

                        <button
                            class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                            Shuffle
                        </button>
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

                                            <button
                                                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 max-w-fit">
                                                Send
                                            </button>
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
