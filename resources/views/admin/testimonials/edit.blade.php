<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-white">
                {{ __('Edit Testimonial') }}
            </h2>
            <a
                href="{{ route('admin.testimonials.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
            >
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Reviewer Name') }} <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Role / Description') }}</label>
                            <input type="text" name="role" id="role" value="{{ old('role', $testimonial->role) }}" placeholder="e.g. Business Owner" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                            @error('role') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>
                        
                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Rating (1-5)') }} <span class="text-red-500">*</span></label>
                            <select name="rating" id="rating" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">
                                <option value="5" @selected(old('rating', $testimonial->rating) == 5)>5 Stars</option>
                                <option value="4" @selected(old('rating', $testimonial->rating) == 4)>4 Stars</option>
                                <option value="3" @selected(old('rating', $testimonial->rating) == 3)>3 Stars</option>
                                <option value="2" @selected(old('rating', $testimonial->rating) == 2)>2 Stars</option>
                                <option value="1" @selected(old('rating', $testimonial->rating) == 1)>1 Star</option>
                            </select>
                            @error('rating') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Status') }}</label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial->is_active)) class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show on Website') }}</span>
                            </label>
                        </div>

                        <!-- Text -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Review Text') }} <span class="text-red-500">*</span></label>
                            <textarea name="text" id="text" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('text', $testimonial->text) }}</textarea>
                            @error('text') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800">
                            {{ __('Update Testimonial') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
