@props(['category' => null])

<div class="space-y-6">
    <!-- Name Field -->
    <div>
        <x-input-label for="name" :value="__('Category Name')" />
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', $category?->name)"
            required
            placeholder="e.g., Mobil, Motor, Truck"
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <!-- Slug Field -->
    <div>
        <x-input-label for="slug" :value="__('Slug')" />
        <x-text-input
            id="slug"
            name="slug"
            type="text"
            class="mt-1 block w-full"
            :value="old('slug', $category?->slug)"
            required
            placeholder="e.g., mobil, motor, truck"
        />
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('URL-friendly identifier for the category (lowercase, no spaces)') }}
        </p>
        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
    </div>

    <!-- Auto-generate Slug Script -->
    <script>
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const slug = name
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>

    <!-- Submit Button -->
    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ $category ? __('Update Category') : __('Create Category') }}
        </x-primary-button>

        <a
            href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
        >
            {{ __('Cancel') }}
        </a>
    </div>
</div>
