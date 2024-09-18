<x-app-layout>
    <div class="mx-auto max-w-screen-lg" x-data="{}">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">{{ $party->name }}</h1>
        </div>
        <div class="grid grid-cols-1 gap-4 pt-4">
            <section>
                <h2 class="text-2xl font-medium">Details</h2>
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Name</span>
                        <span>{{ $party->name }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Description</span>
                        <span>{{ $party->description }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500">Join code</span>
                        <span>{{ $party->join_code }}</span>
                    </div>
            </section>
            <section>
                <h2 class="text-2xl font-medium">Members</h2>
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
                                <td class="p-2 border-2 border-black">
                                    @if ($character->user_id === $current_user_id)
                                        <a href="{{ route('characters.show', $character->id) }}"
                                            class="underline text-blue-500">
                                            {{ $character->name }}
                                        </a>
                                    @else
                                        {{ $character->name }}
                                    @endif
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
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</x-app-layout>
