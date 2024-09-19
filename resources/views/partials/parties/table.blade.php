<table class="w-full text-center">
    <thead class="h-10 bg-black text-white">
        <tr>
            <th class="p-2 border-2 border-black">Name</th>
            <th class="p-2 border-2 border-black">Size</th>
            <th class="p-2 border-2 border-black">Join code</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($parties as $party)
            <tr class="odd:bg-white even:bg-slate-200 hover:bg-slate-300 transition-colors">
                <td class="p-2 border-2 border-black underline text-blue-500">
                    <a href="{{ route('parties.show', $party->id) }}">{{ $party->name }}</a>
                </td>
                <td class="p-2 border-2 border-black">{{ $party->size }}</td>
                <td class="p-2 border-2 border-black">{{ $party->join_code }}</td>
            </tr>
        @endforeach
        <tr class="bg-white">
            <td class="p-2 border-2 border-black text-center hover:bg-slate-300 cursor-pointer" colspan="11">
                <form action="{{ route('parties.store') }}" method="POST">
                    @csrf

                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
