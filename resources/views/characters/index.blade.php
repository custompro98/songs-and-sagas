<x-app-layout>
    <div class="flex flex-col gap-2 max-w-screen-lg mx-auto">
        <h1 class="text-3xl font-bold">Characters</h1>
        <div class="flex justify-center">
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
                    <tr>
                        <td class="p-2 border-2 border-black text-center hover:bg-slate-300 cursor-pointer"
                            colspan="11">
                            <form action="{{ route('characters.generate') }}" method="POST">
                                @csrf

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 inline">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
