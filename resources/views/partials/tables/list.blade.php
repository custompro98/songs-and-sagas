<dl class="grid grid-cols-1 gap-4 divide-y divide-gray-200/75">
    @foreach ($tables as $table)
        <div class="pt-2">
            <h2 class="text-xl font-bold">
                <a href="{{ route('tables.show', $table->id) }}" class="underline text-blue-500">
                    {{ $table->name }}
                </a>
            </h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                <div>
                    <dt class="text-sm text-gray-500">Join code</dt>
                    <dd class="text-sm">
                        <x-button-copy showText="{{ $table->join_code }}" copyText="{{ $table->join_code }}"
                            class="size-5 inline text-gray-500 hover:text-gray-600 active:text-gray-900" />
                    </dd>
                </div>
            </dl>
        </div>
    @endforeach
    <div class="pt-4 text-center">
        <form action="{{ route('tables.generate') }}" method="POST">
            @csrf

            <button
                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                <span>Generate</span>
            </button>
        </form>
    </div>
</dl>
