<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $character->name }}</h1>
            <form action="{{ route('characters.destroy', $character->id) }}" method="POST">
                @csrf
                @method('delete')

                <button
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    <span class="hidden md:inline">Delete</span>
                    <x-icon-x-mark class="size-6 inline md:hidden" />
                </button>
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
                        <div class="flex flex-col gap-1">
                            <label for="armor" class="text-sm text-gray-500">Armor</label>
                            <input type="number" id="armor" name="armor" value="{{ $character->armor }}"
                                class="border border-black h-6 w-10 text-center p-1"
                                x-on:input.change.debounce="$el.closest('form').submit()" />
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
                    <ul>
                        @foreach ($character->notes()->get() as $note)
                            <li class="flex flex-row gap-1">
                                <form
                                    action="{{ route('characters.notes.destroy', ['characterId' => $character->id, 'noteId' => $note->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="x" class="text-red-700 cursor-pointer" />
                                </form>
                                {{ $note->note }}
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
                        <input type="text" name="joinCode" placeholder="dOVuWeFrCUUzNXFh"
                            class="border border-black h-6 w-48 p-1" />
                        <input type="submit" value="Join" class="p-2" />
                    </form>
                </div>
            </section>
        </div>
    </div>
    </div>
</x-app-layout>
