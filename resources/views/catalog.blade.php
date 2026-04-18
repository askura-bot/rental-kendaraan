<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
            {{ __('Vehicle Catalog') }}
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mt-2">
            {{ __('Find your perfect rental vehicle') }}
        </p>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search & Filters Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <form method="GET" action="{{ route('catalog') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Search') }}
                        </label>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="{{ __('Vehicle name or brand...') }}"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Category') }}
                        </label>
                        <select name="category" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->vehicles_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Transmission -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Transmission') }}
                        </label>
                        <select name="transmission" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>{{ __('Manual') }}</option>
                            <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>{{ __('Automatic') }}</option>
                        </select>
                    </div>

                    <!-- Price Range (Min) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Min Price (24h)') }}
                        </label>
                        <input
                            type="number"
                            name="price_min"
                            value="{{ request('price_min') }}"
                            placeholder="0"
                            min="0"
                            step="50000"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >
                    </div>

                    <!-- Price Range (Max) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Max Price (24h)') }}
                        </label>
                        <input
                            type="number"
                            name="price_max"
                            value="{{ request('price_max') }}"
                            placeholder="10000000"
                            min="0"
                            step="50000"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        >
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-end gap-2 lg:col-span-5">
                        <button type="submit" class="flex-1 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition font-medium">
                            {{ __('Search') }}
                        </button>
                        <a href="{{ route('catalog') }}" class="flex-1 px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 dark:bg-gray-600 dark:hover:bg-gray-500 transition text-center font-medium">
                            {{ __('Reset') }}
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $vehicles->total() }} {{ __('vehicles found') }}
                </p>
            </div>

            <!-- Vehicles Grid -->
            @if($vehicles->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach($vehicles as $vehicle)
                        <a href="{{ route('vehicle-detail', $vehicle->slug) }}" class="group">
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl dark:hover:shadow-lg transition overflow-hidden h-full flex flex-col">
                                <!-- Image -->
                                <div class="relative overflow-hidden bg-gray-200 dark:bg-gray-700 h-48">
                                    @if($vehicle->thumbnail)
                                        <img
                                            src="{{ asset('storage/' . $vehicle->thumbnail) }}"
                                            alt="{{ $vehicle->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ __('Available') }}
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-4 flex-1 flex flex-col">
                                    <!-- Title -->
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                        {{ $vehicle->name }}
                                    </h3>

                                    <!-- Brand & Year -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $vehicle->brand }} • {{ $vehicle->year }}
                                    </p>

                                    <!-- Specs -->
                                    <div class="grid grid-cols-2 gap-2 my-3 text-xs text-gray-600 dark:text-gray-400">
                                        <div class="flex items-center gap-1">
                                            <span>⛽</span>
                                            <span>{{ number_format($vehicle->cc) }} CC</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span>👥</span>
                                            <span>{{ $vehicle->capacity }} {{ __('seats') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span>⚙️</span>
                                            <span>{{ ucfirst($vehicle->transmission) }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span>📸</span>
                                            <span>{{ $vehicle->images->count() }} {{ __('photos') }}</span>
                                        </div>
                                    </div>

                                    <!-- Pricing -->
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-auto">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">12 jam</span>
                                            <span class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($vehicle->price_12h) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">24 jam</span>
                                            <span class="font-bold text-blue-600 dark:text-blue-400 text-lg">Rp {{ number_format($vehicle->price_24h) }}</span>
                                        </div>
                                    </div>

                                    <!-- View Details Button -->
                                    <button class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition font-medium">
                                        {{ __('View Details') }}
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $vehicles->links() }}
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('No vehicles found') }}
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ __('Try adjusting your search or filter criteria') }}
                    </p>
                    <a href="{{ route('catalog') }}" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition font-medium">
                        {{ __('View All Vehicles') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
