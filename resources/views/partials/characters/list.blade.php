<dl class="grid grid-cols-1 gap-4 divide-y divide-gray-200/75">
    @foreach ($characters as $character)
        <div class="pt-2">
            <h2 class="text-xl font-bold">
                <a href="{{ route('characters.show', $character->id) }}" class="underline text-blue-500">
                    {{ $character->name }}
                </a>
            </h2>
            <dl class="grid grid-cols-2 gap-2">
                <div>
                    <dt class="text-sm text-gray-500">Pronouns</dt>
                    <dd class="text-sm">{{ $character->pronouns }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Vanori</dt>
                    <dd class="text-sm">{{ $character->vanori }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">STR</dt>
                    <dd class="text-sm">{{ $character->str }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">DEX</dt>
                    <dd class="text-sm">{{ $character->dex }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">WIL</dt>
                    <dd class="text-sm">{{ $character->wil }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">HRT</dt>
                    <dd class="text-sm">{{ $character->hrt }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Armor</dt>
                    <dd class="text-sm">d{{ $character->armor }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Current Resilience</dt>
                    <dd class="text-sm">{{ $character->resilience_current }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Max Resilience</dt>
                    <dd class="text-sm">{{ $character->resilience_max }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Experience</dt>
                    <dd class="text-sm">{{ $character->experience }}</dd>
                </div>
            </dl>
        </div>
    @endforeach
    <div class="pt-4 text-center">
        <form action="{{ route('characters.generate') }}" method="POST">
            @csrf

            <button
                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                <span>Generate</span>
            </button>
        </form>
    </div>
</dl>
