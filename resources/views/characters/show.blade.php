<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $character->name }}</h1>
            <form action="{{ route('characters.destroy', $character->id) }}" method="POST">
                @csrf
                @method('delete')

                <x-danger-button>
                    <span class="hidden md:inline">Delete</span>
                    <x-icon-x-mark class="size-6 inline md:hidden" />
                </x-danger-button>
            </form>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
            <section>
                <form action="{{ route('characters.update', $character->id) }}" method="POST">
                    @csrf
                    @method('patch')

                    <h2 class="text-2xl font-medium">Details</h2>
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="flex flex-col gap-1">
                            <span class="text-sm text-gray-500">Pronouns</span>
                            <span>{{ $character->pronouns }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-sm text-gray-500">Vanori</span>
                            <span>{{ $character->vanori }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="resilience_current" class="text-sm text-gray-500">Resilience</label>
                            <div>
                                <input type="number" id="resilience_current" name="resilience_current"
                                    value="{{ $character->resilience_current }}" min="0"
                                    max="{{ $character->resilience_max }}"
                                    class="border border-black h-6 w-10 text-center p-1"
                                    x-on:input.change.debounce="$el.closest('form').submit()" />
                                <span>/</span>
                                <span>{{ $character->resilience_max }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 w-20">
                            <label for="armor" class="text-sm text-gray-500">Armor</label>
                            <select name="armor" id="armor" x-on:change.debounce="$el.closest('form').submit()">
                                @foreach ($armor_options as $armor)
                                    <option value="{{ $armor->value }}"
                                        {{ $character->armor == $armor->value ? 'selected' : '' }}>
                                        {{ $armor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-sm text-gray-500">Experience</span>
                            <div class="flex flex-row gap-1">
                                @for ($j = 0; $j < 8; $j++)
                                    <input type="checkbox" id="experience-{{ $j }}"
                                        name="experience-{{ $j }}"
                                        x-on:click.debounce="$el.closest('form').submit()"
                                        {{ $character->experience > $j ? 'checked' : '' }} />
                                @endfor
                            </div>
                        </div>
                </form>
            </section>
            <section>
                <form action="{{ route('characters.update', $character->id) }}" method="POST">
                    @csrf
                    @method('patch')

                    <h2 class="text-2xl font-medium">Attributes</h2>
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="flex flex-col gap-1">
                            <label for="str" class="text-sm text-gray-500">STR</label>
                            <input type="number" id="str" name="str" value="{{ $character->str }}"
                                class="border border-black h-6 w-10 text-center p-1"
                                x-on:input.change.debounce="$el.closest('form').submit()" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="dex" class="text-sm text-gray-500">DEX</label>
                            <input type="number" id="dex" name="dex" value="{{ $character->dex }}"
                                class="border border-black h-6 w-10 text-center p-1"
                                x-on:input.change.debounce="$el.closest('form').submit()" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="wil" class="text-sm text-gray-500">WIL</label>
                            <input type="number" id="wil" name="wil" value="{{ $character->wil }}"
                                class="border border-black h-6 w-10 text-center p-1"
                                x-on:input.change.debounce="$el.closest('form').submit()" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="hrt" class="text-sm text-gray-500">HRT</label>
                            <input type="number" id="hrt" name="hrt" value="{{ $character->hrt }}"
                                class="border border-black h-6 w-10 text-center p-1"
                                x-on:input.change.debounce="$el.closest('form').submit()" />
                        </div>
                    </div>
                </form>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Inventory</h2>
                <ul class="grid grid-cols-2">
                    @foreach ($character->inventoryItems()->get() as $item)
                        <li class="p-2 pl-0">
                            <form action="{{ route('inventory_items.update', $item->id) }}" method="POST">
                                @csrf
                                @method('patch')

                                <div class="flex flex-col gap-1">
                                    <label for="item-{{ $item->id }}" class="text-sm text-gray-500">Item</label>
                                    <input type="text" name="name" id="item-{{ $item->id }}"
                                        value="{{ $item->name }}" class="border border-black h-6 w-48 p-1"
                                        x-on:input.debounce.500ms="$el.closest('form').submit()" />
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="item-note-{{ $item->id }}"
                                        class="text-sm text-gray-500">Note</label>
                                    <input type="text" name="note" id="item-note-{{ $item->id }}"
                                        value="{{ $item->note }}" class="border border-black h-6 w-48 p-1"
                                        x-on:input.debounce.500ms="$el.closest('form').submit()" />
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="item-quantity-{{ $item->id }}"
                                        class="text-sm text-gray-500">Quantity</label>
                                    <input type="text" name="quantity" id="item-quantity-{{ $item->id }}"
                                        value="{{ $item->quantity }}" class="border border-black h-6 w-48 p-1"
                                        x-on:input.debounce.500ms="$el.closest('form').submit()" />
                                </div>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Notes</h2>
                <div class="pt-2">
                    <form action="{{ route('characters.notes.store', $character->id) }}" method="POST">
                        @csrf

                        <input type="text" id="note" name="note" class="border border-black w-full"
                            placeholder="{{ $character->name }} discovered something about themselves..." />
                    </form>
                    <ul class="pt-2 grid grid-cols-1 gap-2">
                        @foreach ($character->notes()->get() as $note)
                            <li class="grid grid-cols-12 gap-1 items-center justify-center p-2"
                                x-data="{ edit: false }">
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                                    class="grid grid-cols-subgrid">
                                    @csrf
                                    @method('delete')

                                    <button>
                                        <x-icon-x-mark class="size-5 text-red-700" />
                                    </button>
                                </form>
                                <div class="col-span-10">
                                    <p x-show="!edit">{{ $note->note }}</p>
                                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                                        x-show="edit">
                                        @csrf
                                        @method('patch')

                                        <input type="text" id="note" name="note"
                                            class="border border-black w-full h-6" value="{{ $note->note }}"
                                            placeholder="{{ $character->name }} discovered something about themselves..." />
                                    </form>
                                </div>
                                <button x-on:click="edit = !edit">
                                    <x-icon-pencil-square class="size-5" />
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Parties</h2>
                <div class="pt-2">
                    <ul>
                        @if ($character->parties()->count() > 0)
                            @foreach ($character->parties()->get() as $party)
                                <li class="flex flex-row gap-1">
                                    <a href="{{ route('parties.show', $party->id) }}"
                                        class="underline text-blue-500">{{ $party->name }}</a>
                                </li>
                            @endforeach
                        @else
                            <li>No obligations...<em>yet</em>.</li>
                        @endif
                    </ul>
                    <form action="{{ route('party_members.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="characterId" value="{{ $character->id }}" />
                        <input type="text" name="join_code" placeholder="dOVuWeFrCUUzNXFh"
                            class="border border-black h-6 w-48 p-1" />
                        <input type="submit" value="Join" class="p-2 cursor-pointer" />
                    </form>
                </div>
            </section>
        </div>
        <section class="pt-4">
            <h2 class="text-2xl font-medium">Hand</h2>
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:gap-0 lg:grid-cols-1 pt-2 isolate">
                @foreach ($character->hand()->get() as $card)
                    <div class="flex flex-col gap-1 border-2 border-gray-300 bg-white shadow p-2 rounded-lg justify-center items-center aspect-[63/88] max-w-40 lg:col-start-1 lg:row-start-1 lg:translate-x-[{{ 6 * $loop->index }}rem] lg:z-[-{{ $loop->index }}] lg:hover:z-[100] lg:hover:translate-y-[-1rem] lg:translate-x-[{{ 6 * $loop->index }}rem] lg:transition-all lg:ease-in-ease-out lg:duration-300 cursor-pointer"
                        x-on:click="selectedCard = {{ $card->id }}; $dispatch('open-modal', 'discard-{{ $card->id }}')">
                        <span>{{ $card->rank }}</span>
                        <span>of</span>
                        <span>{{ $card->suit }}</span>
                    </div>
                    <x-modal name="discard-{{ $card->id }}" focusable>
                        <div class="flex flex-col gap-4">
                            <div class="border-b border-gray-100 bg-white p-4">
                                <h3 class="text-xl font-medium">Discard?</h3>
                            </div>
                            <form method="POST" action="{{ route('cards.discard', $card->id) }}"
                                class="p-6 flex flex-row gap-4">
                                @csrf
                                @method('patch')

                                <button
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Discard
                                </button>
                            </form>
                        </div>
                    </x-modal>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
