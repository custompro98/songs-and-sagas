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
                <td class="p-2 border-2 border-black">
                    <x-button-copy showText="{{ $party->join_code }}" copyText="{{ $party->join_code }}"
                        class="size-5 inline text-gray-500 hover:text-gray-600 active:text-gray-900" />
                </td>
            </tr>
        @endforeach
        <tr class="bg-white">
            <td class="p-2 border-2 border-black text-center hover:bg-slate-300" colspan="11">
                <form action="{{ route('parties.generate') }}" method="POST">
                    @csrf

                    <button>
                        <span>Generate</span>
                    </button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
