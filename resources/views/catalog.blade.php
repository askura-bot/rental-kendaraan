<x-public-layout>
    {{-- Page Header --}}
    <section class="bg-primary-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4">{{ __('Our Vehicles') }}</h1>
            <p class="text-primary-200 text-lg max-w-2xl mx-auto">{{ __('Choose car transportation for your trip. Browse our complete collection of quality rental vehicles.') }}</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Search & Filters --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-10">
                <form method="GET" action="{{ route('vehicles') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Search') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Vehicle name or brand...') }}"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Category') }}</label>
                        <select name="category" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
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
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Transmission') }}</label>
                        <select name="transmission" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                            <option value="">{{ __('All Types') }}</option>
                            <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>{{ __('Manual') }}</option>
                            <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>{{ __('Automatic') }}</option>
                        </select>
                    </div>

                    <!-- Price Range (Min) -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Min Price') }}</label>
                        <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="0" min="0" step="50000"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>

                    <!-- Price Range (Max) -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Max Price') }}</label>
                        <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="10000000" min="0" step="50000"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-end gap-3 lg:col-span-5">
                        <button type="submit" class="flex-1 sm:flex-none px-8 py-2.5 bg-primary-700 text-white font-semibold rounded-xl hover:bg-primary-800 transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            {{ __('Search') }}
                        </button>
                        <a href="{{ route('vehicles') }}" class="flex-1 sm:flex-none px-8 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-colors duration-200 text-center">{{ __('Reset') }}</a>
                    </div>
                </form>
            </div>

            {{-- Results Count --}}
            <div class="mb-8 flex items-center justify-between">
                <p class="text-lg font-bold text-gray-900">
                    {{ $vehicles->total() }} {{ __('vehicles found') }}
                </p>
            </div>

            {{-- Vehicles Grid --}}
            @if($vehicles->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
                    @foreach($vehicles as $vehicle)
                        <a href="{{ route('vehicle-detail', $vehicle->slug) }}" class="group">
                            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 h-full flex flex-col">
                                <!-- Image -->
                                <div class="relative bg-gray-100 h-48 overflow-hidden">
                                    @if($vehicle->thumbnail)
                                        <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 right-3 bg-primary-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ __('Available') }}
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-base font-bold text-gray-900 mb-1 group-hover:text-primary-700 transition-colors">{{ $vehicle->name }}</h3>
                                    <p class="text-sm text-gray-500 mb-3">{{ $vehicle->brand }} • {{ $vehicle->year }}</p>

                                    <!-- Specs -->
                                    <div class="grid grid-cols-2 gap-2 mb-4 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">⛽ {{ number_format($vehicle->cc) }} CC</span>
                                        <span class="flex items-center gap-1">👥 {{ $vehicle->capacity }} {{ __('seats') }}</span>
                                        <span class="flex items-center gap-1">⚙️ {{ ucfirst($vehicle->transmission) }}</span>
                                        <span class="flex items-center gap-1">📸 {{ $vehicle->images->count() }} {{ __('photos') }}</span>
                                    </div>

                                    <!-- Pricing -->
                                    <div class="border-t border-gray-100 pt-3 mt-auto">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs text-gray-400">12 {{ __('hours') }}</span>
                                            <span class="font-bold text-sm text-gray-700">Rp {{ number_format($vehicle->price_12h, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-xs text-gray-400">24 {{ __('hours') }}</span>
                                            <span class="font-extrabold text-primary-700 text-lg">Rp {{ number_format($vehicle->price_24h, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    <button class="mt-4 w-full px-4 py-2.5 bg-primary-700 text-white rounded-xl hover:bg-primary-800 transition-colors duration-200 font-semibold text-sm">
                                        {{ __('View Details') }}
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center mt-10">
                    {{ $vehicles->links() }}
                </div>
            @else
                {{-- No Results --}}
                <div class="text-center py-20">
                    <svg class="mx-auto h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-6 text-xl font-bold text-gray-900">{{ __('No vehicles found') }}</h3>
                    <p class="mt-2 text-gray-500">{{ __('Try adjusting your search or filter criteria') }}</p>
                    <a href="{{ route('vehicles') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-3 bg-primary-700 text-white font-semibold rounded-xl hover:bg-primary-800 transition-colors duration-200">
                        {{ __('View All Vehicles') }}
                    </a>
                </div>
            @endif
        </div>
    </section>
</x-public-layout>
