<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $table->name }}</h1>
            <div class="flex flex-row gap-2">
                <form action="{{ route('tables.edit', $table->id) }}">
                    <x-secondary-button type="submit">Edit</x-secondary-button>
                </form>
                <form action="{{ route('tables.destroy', $table->id) }}">
                    <x-danger-button>Delete</x-danger-button>
                </form>
            </div>
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
                            <div class="flex flex-row gap-1">
                                <span>{{ $party->name }}</span>
                                <form action="{{ route('table_parties.destroy', $tableParty->id) }}" method="POST"
                                    class="flex flex-row items-center">
                                    @csrf
                                    @method('delete')

                                    <button>
                                        <x-icon-x-mark class="size-5 text-red-700" />
                                    </button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('table_parties.store') }}" method="POST"
                                class="flex flex-row gap-2">
                                @csrf

                                <input type="hidden" name="table_id" value="{{ $table->id }}">
                                <input type="text" name="join_code" placeholder="QvD0Hx4GWc9CR4f3" />
                                <input type="submit" value="Invite" class="p-2 cursor-pointer" />
                            </form>
                        @endif
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Description</span>
                        <span>{{ $table->description }}</span>
                    </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Characters</h2>
                <div class="lg:flex justify-center hidden pt-2">
                    @include('partials.characters.table', [
                        'characters' => $characters,
                        'includeCreate' => false,
                    ])
                </div>
                <div class="lg:hidden">
                    @include('partials.characters.list', ['characters' => $characters])
                </div>
            </section>
            <section x-data="{
                rolls: [],
                rolldN(n) {
                    this.rolls = [
                        { face: n, value: Math.floor(Math.random() * n) + 1 },
                        ...this.rolls
                    ];
                }
            }">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-medium">Tray</h2>
                    <button x-on:click="rolls = []">
                        <x-icon-x-mark class="size-6 inline text-red-700" />
                    </button>
                </div>
                <div class="pt-2 flex flex-row gap-8">
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ([2, 4, 6, 8, 10, 12, 20, 100] as $face)
                            <x-secondary-button class="w-16" x-on:click="rolldN({{ $face }})">
                                d{{ $face }}
                            </x-secondary-button>
                        @endforeach
                    </div>
                    <div class="border-2 border-gray-300 bg-white shadow shadow-gray-300 flex-grow">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-12 gap-2 p-2 max-h-36 overflow-y-auto overflow-x-hidden">
                            <template x-for="roll in rolls">
                                <div class="flex flex-col gap-1 items-center border border-gray-200 w-16 h-16 p-1"
                                    :class="{
                                        'bg-green-100': roll.face === 20 && roll.value === 1,
                                        'bg-red-100': roll.face === 20 && roll.value === 20,
                                    }">
                                    <label class="text-sm text-gray-600">d<span x-text="roll.face"></span></label>
                                    <span class="text-lg"
                                        :class="{
                                            'text-green-700': roll.face === 20 && roll.value === 1,
                                            'text-red-700': roll.face === 20 && roll.value === 20,
                                        }"
                                        x-text="roll.value"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Deck</h2>
                <div class="pt-2">
                    @if ($deck)
                        <div class="flex flex-row gap-1">
                            <a href="{{ route('decks.show', $deck->id) }}" class="underline text-blue-500">
                                {{ $deck->name }}
                            </a>
                            <form action="{{ route('table_decks.destroy', $tableDeck->id) }}" method="POST"
                                class="flex flex-row items-center">
                                @csrf
                                @method('delete')

                                <button>
                                    <x-icon-x-mark class="size-5 text-red-700" />
                                </button>
                            </form>
                        </div>

                        <div class="flex flex-row gap-2 pt-4">
                            <form hx-post="{{ route('decks.draw', $deck) }}" hx-swap="outerHTML"
                                hx-target="#discard-pile">
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
                    @else
                        <form action="{{ route('table_decks.store') }}" method="POST" class="flex flex-row gap-2">
                            @csrf

                            <input type="hidden" name="table_id" value="{{ $table->id }}">
                            <select name="deck_id" id="deck_id" class="max-w-fit">
                                <option value="">-</option>
                                @foreach ($decks as $deckl)
                                    <option value="{{ $deckl->id }}">
                                        {{ $deckl->name }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="submit" value="Set" class="p-2 cursor-pointer" />
                        </form>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
