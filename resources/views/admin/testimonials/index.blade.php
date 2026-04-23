<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-white">
                {{ __('Testimonials') }}
            </h2>
            <a
                href="{{ route('admin.testimonials.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
            >
                {{ __('+ Add Testimonial') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if ($message = session('success'))
                <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 dark:bg-gray-800 dark:text-green-400">
                    {{ $message }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Name & Role') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Review') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Rating') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Status') }}
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-200">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($testimonials as $testimonial)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    <strong>{{ $testimonial->name }}</strong>
                                    <div class="text-xs text-gray-500">{{ $testimonial->role }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                    {{ Str::limit($testimonial->text, 50) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-yellow-500">
                                    @for($i=0; $i<$testimonial->rating; $i++)
                                        ★
                                    @endfor
                                    @for($i=0; $i<(5 - $testimonial->rating); $i++)
                                        <span class="text-gray-300">★</span>
                                    @endfor
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($testimonial->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a
                                        href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 mr-4"
                                    >
                                        {{ __('Edit') }}
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure? This action cannot be undone.')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <p class="text-sm">{{ __('No testimonials found.') }}</p>
                                    <a href="{{ route('admin.testimonials.create') }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400">
                                        {{ __('Add your first testimonial') }}
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
