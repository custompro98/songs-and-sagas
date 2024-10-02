<table class="w-full text-center">
    <thead class="h-10 bg-black text-white">
        <tr>
            <th class="p-2 border-2 border-black">Name</th>
            <th class="p-2 border-2 border-black">Party</th>
            <th class="p-2 border-2 border-black">Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tables as $table)
            <tr class="odd:bg-white even:bg-slate-200 hover:bg-slate-300 transition-colors">
                <td class="p-2 border-2 border-black underline text-blue-500">
                    <a href="{{ route('tables.show', $table->id) }}">{{ $table->name }}</a>
                </td>
                @if ($table->party()->first())
                    <td class="p-2 border-2 border-black underline text-blue-500">
                        <a href="{{ route('tables.show', $table->id) }}">{{ $table->party()->first()->name }}</a>
                    </td>
                @else
                    <td class="p-2 border-2 border-black">
                        <span>No heroes...<em>yet</em>.</span>
                    </td>
                @endif
                <td class="p-2 border-2 border-black whitespace-nowrap overflow-hidden overflow-ellipsis max-w-80">
                    <span>{{ $table->description }}</span>
                </td>
            </tr>
        @endforeach
        @if ($includeCreate)
            <tr class="bg-white">
                <td class="p-2 border-2 border-black text-center hover:bg-slate-300" colspan="11">
                    <form action="{{ route('tables.generate') }}" method="POST">
                        @csrf

                        <button>
                            <span>Generate</span>
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    </tbody>
</table>
