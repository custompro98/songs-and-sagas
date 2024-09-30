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
                <button type="submit"
                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
