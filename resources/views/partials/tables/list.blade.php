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
                    <dt class="text-sm text-gray-500">Description</dt>
                    <dd class="text-sm">
                        <p>{{ $table->description }}</p>
                    </dd>
                </div>
            </dl>
        </div>
    @endforeach
    <div class="pt-4 text-center">
        <form action="{{ route('tables.generate') }}" method="POST">
            @csrf

            <x-primary-button>
                <span>Generate</span>
            </x-primary-button>
        </form>
    </div>
</dl>
