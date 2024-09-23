<dl class="grid grid-cols-1 gap-4 divide-y divide-gray-200/75">
    @foreach ($parties as $party)
        <div class="pt-2">
            <h2 class="text-xl font-bold">
                <a href="{{ route('parties.show', $party->id) }}" class="underline text-blue-500">
                    {{ $party->name }}
                </a>
            </h2>
            <dl class="grid grid-cols-2 gap-2">
                <div>
                    <dt class="text-sm text-gray-500">Size</dt>
                    <dd class="text-sm">{{ $party->size }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Join code</dt>
                    <dd class="text-sm">
                        <x-button-copy showText="{{ $party->join_code }}" copyText="{{ $party->join_code }}"
                            class="size-5 inline text-gray-500 hover:text-gray-600 active:text-gray-900" />
                    </dd>
                </div>
            </dl>
        </div>
    @endforeach
</dl>
