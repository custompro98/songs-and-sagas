<dl class="grid grid-cols-1 gap-4 divide-y divide-gray-200/75">
    @foreach ($decks as $deck)
        <div class="pt-2">
            <h2 class="text-xl font-bold">
                <a href="{{ route('decks.show', $deck->id) }}" class="underline text-blue-500">
                    {{ $deck->name }}
                </a>
            </h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                <div>
                    <dt class="text-sm text-gray-500">Description</dt>
                    <dd class="text-sm">{{ $deck->description }}</dd>
                </div>
            </dl>
        </div>
    @endforeach
</dl>
