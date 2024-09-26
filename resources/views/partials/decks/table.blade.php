<table class="w-full text-center">
    <thead class="h-10 bg-black text-white">
        <tr>
            <th class="p-2 border-2 border-black">Name</th>
            <th class="p-2 border-2 border-black">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($decks as $deck)
            <tr class="odd:bg-white even:bg-slate-200 hover:bg-slate-300 transition-colors">
                <td class="p-2 border-2 border-black underline text-blue-500">
                    <a href="{{ route('decks.show', $deck->id) }}">{{ $deck->name }}</a>
                </td>
                <td class="p-2 border-2 border-black whitespace-nowrap overflow-hidden overflow-ellipsis max-w-80">
                    {{ $deck->description }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
