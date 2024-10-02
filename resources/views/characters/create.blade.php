<x-app-layout>
    <div class="mx-auto max-w-screen-lg">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">New character</h1>
        </div>
        <form action="{{ route('characters.store') }}" method="POST" class="grid grid-cols-1 gap-4 pt-4">
            @csrf
            <p><em>None of the fields shown will be modified by your Vanori.</em></p>

            <div class="flex flex-col gap-1">
                <label for="name">
                    Name
                    <span class="text-red-500 text-sm">*</span>

                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ugrid" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1" x-data="{}">
                <label for="pronouns">
                    Pronouns
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <select name="pronouns" id="pronouns">
                    <option value="">-</option>
                    @foreach ($pronoun_options as $pronouns)
                        <option value="{{ $pronouns }}"
                            {{ old('pronouns') === $pronouns->value ? 'selected' : '' }}>
                            {{ $pronouns }}
                        </option>
                    @endforeach
                </select>
                @error('pronouns')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="vanori">
                    Vanori
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <select name="vanori" id="vanori">
                    <option value="">-</option>
                    @foreach ($vanori_options as $vanori)
                        <option value="{{ $vanori }}" {{ old('vanori') === $vanori->value ? 'selected' : '' }}>
                            {{ $vanori }}
                        </option>
                    @endforeach
                </select>
                @error('vanori')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="str">
                    Strength
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <input type="number" name="str" id="str" min="-1" max="4"
                    value="{{ old('str') }}" placeholder="1" />
                @error('str')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="dex">
                    Dexterity
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <input type="number" name="dex" id="dex" min="-1" max="4"
                    value="{{ old('dex') }}" placeholder="2" />
                @error('dex')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="wil">
                    Willpower
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <input type="number" name="wil" id="wil" min="-1" max="4"
                    value="{{ old('wil') }}" placeholder="-1" />
                @error('wil')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="hrt">
                    Heart
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <input type="number" name="hrt" id="hrt" min="-1" max="4"
                    value="{{ old('hrt') }}" placeholder="0" />
                @error('hrt')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="resilience">
                    Resilience
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <input type="number" name="resilience" id="resilience" min="4" max="15"
                    value="{{ old('resilience') }}" placeholder="9" />
                @error('resilience')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="armor">
                    Armor
                    <span class="text-red-500 text-sm">*</span>
                </label>
                <select name="armor" id="armor">
                    <option value="">-</option>
                    @foreach ($armor_options as $armor)
                        <option value="{{ $armor->value }}" {{ old('armor') == $armor->value ? 'selected' : '' }}>
                            {{ $armor->name }}
                        </option>
                    @endforeach
                </select>
                @error('armor')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <x-primary-button>
                    Create
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
