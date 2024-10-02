<x-app-layout>
    <div class="mx-auto max-w-screen-lg">
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-3xl font-bold">New table</h1>
        </div>
        <form action="{{ route('tables.store') }}" method="POST" class="grid grid-cols-1 gap-4 pt-4">
            @csrf

            <div class="flex flex-col gap-1">
                <label for="name">
                    Name
                    <span class="text-red-500 text-sm">*</span>

                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Into the Darkness" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="description">Description</label>
                <textarea name="description" id="description" value="{{ old('description') }}"
                    placeholder="A table for the Into the Darkness campaign"></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <x-primary-button>Create</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
