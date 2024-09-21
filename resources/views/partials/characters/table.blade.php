<table class="w-full text-center">
    <thead class="h-10 bg-black text-white">
        <tr>
            <th class="p-2 border-2 border-black">Name</th>
            <th class="p-2 border-2 border-black">Pronouns</th>
            <th class="p-2 border-2 border-black">Vanori</th>
            <th class="p-2 border-2 border-black">STR</th>
            <th class="p-2 border-2 border-black">DEX</th>
            <th class="p-2 border-2 border-black">WIL</th>
            <th class="p-2 border-2 border-black">HRT</th>
            <th class="p-2 border-2 border-black">Armor</th>
            <th class="p-2 border-2 border-black">Current Resilience</th>
            <th class="p-2 border-2 border-black">Max Resilience</th>
            <th class="p-2 border-2 border-black">Experience</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($characters as $character)
            <tr class="odd:bg-white even:bg-slate-200 hover:bg-slate-300 transition-colors">
                <td class="p-2 border-2 border-black underline text-blue-500">
                    <a href="{{ route('characters.show', $character->id) }}">{{ $character->name }}</a>
                </td>
                <td class="p-2 border-2 border-black">{{ $character->pronouns }}</td>
                <td class="p-2 border-2 border-black">{{ $character->vanori }}</td>
                <td class="p-2 border-2 border-black">{{ $character->str }}</td>
                <td class="p-2 border-2 border-black">{{ $character->dex }}</td>
                <td class="p-2 border-2 border-black">{{ $character->wil }}</td>
                <td class="p-2 border-2 border-black">{{ $character->hrt }}</td>
                <td class="p-2 border-2 border-black">{{ $character->armor }}</td>
                <td class="p-2 border-2 border-black">{{ $character->resilience_current }}</td>
                <td class="p-2 border-2 border-black">{{ $character->resilience_max }}</td>
                <td class="p-2 border-2 border-black">{{ $character->experience }}</td>
            </tr>
        @endforeach
        @if ($includeCreate)
            <tr class="bg-white">
                <td class="p-2 border-2 border-black text-center hover:bg-slate-300 cursor-pointer" colspan="11">
                    <form action="{{ route('characters.generate') }}" method="POST">
                        @csrf

                        <button>
                            <x-icon-plus class="size-6 inline" />
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    </tbody>
</table>
