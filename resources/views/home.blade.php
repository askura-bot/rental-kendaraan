<x-public-layout>
    {{-- ==============================
         HERO SECTION
    ============================== --}}
    <section class="relative bg-primary-900 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900 via-primary-900/95 to-primary-900/70"></div>
        <!-- Decorative shapes -->
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-primary-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-40 w-56 h-56 bg-primary-300 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Text Content -->
                <div>
                    <div class="inline-flex items-center gap-2 bg-primary-800/50 rounded-full px-4 py-1.5 mb-6">
                        <div class="flex items-center">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-xs text-gray-300 font-medium">4.9/5 {{ __('Rating') }}</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        {{ __('Find a vehicle that') }}
                        <span class="text-primary-300">{{ __('comfortable') }}</span>
                        {{ __('for you') }}
                    </h1>
                    <p class="text-base sm:text-lg text-gray-300 mb-8 max-w-lg">
                        {{ __('Trusted car rental service with top-rated reviews. Quality vehicles for every journey.') }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('vehicles') }}" class="inline-flex items-center gap-2 px-5 sm:px-7 py-3 sm:py-3.5 bg-white text-primary-800 font-bold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-lg shadow-white/10 text-sm sm:text-base">
                            {{ __('Browse Vehicles') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-5 sm:px-7 py-3 sm:py-3.5 border-2 border-white/30 text-white font-bold rounded-xl hover:bg-white/10 transition-all duration-300 text-sm sm:text-base">
                            {{ __('Contact Us') }}
                        </a>
                    </div>
                </div>

                <!-- Right: Hero Image -->
                <div class="relative hidden lg:block">
                    <div class="relative z-10">
                        @if($featuredVehicle && $featuredVehicle->thumbnail)
                            <img src="{{ asset('storage/' . $featuredVehicle->thumbnail) }}" alt="{{ $featuredVehicle->name }}" class="w-full h-auto drop-shadow-2xl rounded-2xl">
                        @else
                            <div class="w-full aspect-[16/10] bg-gradient-to-br from-primary-700 to-primary-800 rounded-2xl flex items-center justify-center">
                                <svg class="w-32 h-32 text-primary-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <!-- Glow behind image -->
                    <div class="absolute -inset-6 bg-primary-400/10 rounded-3xl blur-2xl -z-0"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==============================
         ABOUT / TRUSTED SECTION
    ============================== --}}
    <section class="py-12 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <!-- Left: Motorcycle Image (16:9) -->
                <div class="relative order-1 lg:order-1">
                    <div class="rounded-2xl overflow-hidden shadow-xl aspect-video">
                        <img src="{{ asset('images/motorcycle-hero.png') }}" alt="{{ __('Premium Motorcycle') }}" class="w-full h-full object-cover">
                    </div>
                    <!-- Decorative badge -->
                    <div class="absolute -bottom-4 right-2 sm:-right-4 bg-primary-700 text-white rounded-2xl px-5 py-3 sm:px-6 sm:py-4 shadow-xl z-10">
                        <p class="text-2xl font-extrabold">10+</p>
                        <p class="text-xs text-primary-200">{{ __('Years Experience') }}</p>
                    </div>
                    <!-- Subtle glow behind image -->
                    <div class="absolute -inset-3 bg-primary-200/30 rounded-3xl blur-2xl -z-10"></div>
                </div>

                <!-- Right: Text Content -->
                <div class="order-2 lg:order-2">
                    <span class="inline-block text-primary-600 text-sm font-semibold uppercase tracking-wider mb-3">{{ __('Welcome to') }} {{ config('app.name', 'DriveEase') }}</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                        {{ __('Trusted and Quality Car Rental Place') }}
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        {{ __('With a solid reputation and positive customer reviews, we are known for our reliability and outstanding high-quality services. Your comfort and satisfaction are our top priority.') }}
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-6 mb-8">
                        <div class="text-center p-3 sm:p-4 bg-primary-100 border border-primary-200 rounded-2xl shadow-sm">
                            <p class="text-xl sm:text-3xl font-extrabold text-primary-800">{{ $totalVehicles }}+</p>
                            <p class="text-xs text-gray-600 mt-1">{{ __('Cars Available') }}</p>
                        </div>
                        <div class="text-center p-3 sm:p-4 bg-primary-100 border border-primary-200 rounded-2xl shadow-sm">
                            <p class="text-xl sm:text-3xl font-extrabold text-primary-800">15K+</p>
                            <p class="text-xs text-gray-600 mt-1">{{ __('Happy Customers') }}</p>
                        </div>
                        <div class="text-center p-3 sm:p-4 bg-primary-100 border border-primary-200 rounded-2xl shadow-sm">
                            <p class="text-xl sm:text-3xl font-extrabold text-primary-800">20K+</p>
                            <p class="text-xs text-gray-600 mt-1">{{ __('Successful Rentals') }}</p>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-3 gap-2 sm:gap-4">
                        <div class="flex flex-col items-center text-center p-3 sm:p-4 bg-primary-50 border border-primary-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-2 sm:mb-3">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-700">{{ __('Location') }}</p>
                        </div>
                        <div class="flex flex-col items-center text-center p-3 sm:p-4 bg-primary-50 border border-primary-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-2 sm:mb-3">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-700">{{ __('Pick-Up') }}</p>
                        </div>
                        <div class="flex flex-col items-center text-center p-3 sm:p-4 bg-primary-50 border border-primary-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-2 sm:mb-3">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-700">{{ __('Connect') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==============================
         VEHICLES SECTION
    ============================== --}}
    <section class="py-12 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                    {{ __('Choose car transportation for your trip') }}
                </h2>
            </div>


            <!-- Search Bar -->
            <div class="max-w-4xl mx-auto mb-10">
                <form action="{{ route('vehicles') }}" method="GET" class="bg-white rounded-2xl shadow-md border border-primary-200 p-3 flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="search" placeholder="{{ __('Search vehicles...') }}" class="flex-1 bg-transparent border-none text-sm text-gray-700 placeholder-gray-400 focus:ring-0 focus:outline-none">
                    </div>
                    <div class="flex-1 flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <select name="category" class="flex-1 bg-transparent border-none text-sm text-gray-700 focus:ring-0">
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="px-8 py-3 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-xl transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ __('Search') }}
                    </button>
                </form>
            </div>

            <!-- Vehicle Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($vehicles->take(3) as $vehicle)
                    <a href="{{ route('vehicle-detail', $vehicle->slug) }}" class="group">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                            <!-- Image -->
                            <div class="relative bg-gray-100 h-52 overflow-hidden">
                                @if($vehicle->thumbnail)
                                    <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary-700 transition-colors">
                                    {{ $vehicle->name }}
                                </h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $vehicle->brand }} • {{ $vehicle->year }}</p>

                                <!-- Specs -->
                                <div class="flex items-center gap-4 mb-4 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $vehicle->capacity }} {{ __('Seats') }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ ucfirst($vehicle->transmission) }}
                                    </span>
                                </div>

                                <!-- Price -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-400">{{ __('Starting from') }}</p>
                                        <p class="text-lg font-extrabold text-primary-700">Rp {{ number_format($vehicle->price_24h, 0, ',', '.') }}<span class="text-xs font-normal text-gray-400">/{{ __('Day') }}</span></p>
                                    </div>
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-primary-200 rounded-xl text-primary-800 group-hover:bg-primary-700 group-hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="{{ route('vehicles') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-primary-700 text-white font-semibold rounded-xl hover:bg-primary-800 transition-colors duration-200 shadow-lg shadow-primary-700/20">
                    {{ __('View All Vehicles') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ==============================
         TESTIMONIALS SECTION
    ============================== --}}
    <section class="py-12 sm:py-20 bg-primary-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">
                    {{ __('More than') }} <span class="text-primary-700">15K+</span> {{ __('people have') }}<br class="hidden sm:block">{{ __('been satisfied with driving') }}
                </h2>
            </div>

            @if($testimonials->count() > 3)
                <style>
                    @keyframes scroll {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(calc(-50% - 1rem)); }
                    }
                    .animate-scroll {
                        animation: scroll 30s linear infinite;
                    }
                    .animate-scroll:hover {
                        animation-play-state: paused;
                    }
                </style>
                <div class="overflow-hidden relative w-full pb-4">
                    <div class="flex gap-8 w-max animate-scroll">
                        @foreach([1, 2] as $loopIndex)
                            <div class="flex gap-8 w-max">
                                @foreach($testimonials as $testimonial)
                                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-primary-100 shadow-sm hover:shadow-lg transition-shadow duration-300 w-80 shrink-0">
                                        <div class="flex items-center gap-1 mb-4">
                                            @for($i = 0; $i < $testimonial->rating; $i++)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                            @for($i = 0; $i < (5 - $testimonial->rating); $i++)
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed mb-6 whitespace-normal">"{{ $testimonial->text }}"</p>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold text-sm shrink-0">
                                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                            </div>
                                            <div class="overflow-hidden">
                                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $testimonial->name }}</p>
                                                <p class="text-xs text-gray-500 truncate">{{ $testimonial->role }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($testimonials as $testimonial)
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-primary-100 shadow-sm hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center gap-1 mb-4">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                                @for($i = 0; $i < (5 - $testimonial->rating); $i++)
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">"{{ $testimonial->text }}"</p>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold text-sm">
                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $testimonial->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $testimonial->role }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-8">
                            <p class="text-gray-500">{{ __('Be the first to review us!') }}</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </section>

    {{-- ==============================
         NEWSLETTER / CTA SECTION
    ============================== --}}
    <section class="py-12 sm:py-20 bg-primary-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-4">
                {{ __('Get exclusive deals with us') }}
            </h2>
            <p class="text-primary-200 mb-8 max-w-lg mx-auto">
                {{ __('Subscribe to our newsletter and get the latest offers and rental deals delivered to your inbox.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto">
                <input type="email" placeholder="{{ __('Enter your email') }}" class="flex-1 px-5 py-3.5 rounded-xl border-none text-sm text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-primary-400">
                <button class="px-8 py-3.5 bg-white text-primary-800 font-bold rounded-xl hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                    {{ __('Subscribe') }}
                </button>
            </div>
        </div>
    </section>
</x-public-layout>
