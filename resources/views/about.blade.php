<x-public-layout>
    {{-- Page Header --}}
    <section class="bg-primary-900 py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-4">{{ __('About Us') }}</h1>
            <p class="text-primary-200 text-base sm:text-lg max-w-2xl mx-auto">{{ __('Get to know more about our commitment to providing the best car rental experience.') }}</p>
        </div>
    </section>

    {{-- Our Story --}}
    <section class="py-12 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div>
                    <span class="inline-block text-primary-600 text-sm font-semibold uppercase tracking-wider mb-3">{{ __('Our Story') }}</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                        {{ __('Trusted and Quality Car Rental Place') }}
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ __('With a solid reputation and positive customer reviews, we are known for our reliability and outstanding high-quality services. Your comfort and satisfaction are our top priority.') }}
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        {{ __('Since our founding, we have served thousands of customers across Indonesia, providing well-maintained vehicles at competitive prices. Our team is dedicated to ensuring every rental experience exceeds expectations.') }}
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-6">
                        <div class="text-center p-3 sm:p-5 bg-primary-100 border border-primary-200 rounded-2xl shadow-sm">
                            <p class="text-xl sm:text-3xl font-extrabold text-primary-800">15K+</p>
                            <p class="text-xs text-gray-600 mt-1">{{ __('Happy Customers') }}</p>
                        </div>
                        <div class="text-center p-3 sm:p-5 bg-primary-100 border border-primary-200 rounded-2xl shadow-sm">
                            <p class="text-xl sm:text-3xl font-extrabold text-primary-800">{{ $totalVehicles }}+</p>
                            <p class="text-xs text-gray-600 mt-1">{{ __('Cars Available') }}</p>
                        </div>
                        <div class="text-center p-3 sm:p-5 bg-primary-100 border border-primary-200 rounded-2xl shadow-sm">
                            <p class="text-xl sm:text-3xl font-extrabold text-primary-800">20K+</p>
                            <p class="text-xs text-gray-600 mt-1">{{ __('Successful Rentals') }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($vehicles->take(2) as $vehicle)
                            @if($vehicle->thumbnail)
                                <div class="rounded-2xl overflow-hidden shadow-lg {{ $loop->first ? 'aspect-[4/5]' : 'aspect-[4/5] mt-8' }}">
                                    <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="rounded-2xl bg-gray-100 {{ $loop->first ? 'aspect-[4/5]' : 'aspect-[4/5] mt-8' }} flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="absolute -bottom-4 right-2 sm:-right-4 bg-primary-700 text-white rounded-2xl px-5 py-3 sm:px-6 sm:py-4 shadow-xl z-10">
                        <p class="text-2xl font-extrabold">10+</p>
                        <p class="text-xs text-primary-200">{{ __('Years Experience') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-12 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">{{ __('Why Choose Us') }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">{{ __('We provide the best service to ensure your journey is comfortable and safe.') }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @php
                    $features = [
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => __('Safety First'), 'desc' => __('All vehicles undergo rigorous safety inspections and regular maintenance.')],
                        ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => __('Best Price'), 'desc' => __('Competitive rates with no hidden charges. Best value guaranteed.')],
                        ['icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => __('24/7 Support'), 'desc' => __('Our customer support team is available around the clock to assist you.')],
                        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'title' => __('Fast Booking'), 'desc' => __('Quick and easy booking process. Get your car ready in minutes.')],
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="bg-white rounded-2xl p-5 sm:p-7 text-center border border-primary-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 bg-primary-700 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12 sm:py-20 bg-primary-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">{{ __('Ready to start your journey?') }}</h2>
            <p class="text-primary-200 mb-8 max-w-lg mx-auto">{{ __('Browse our collection and find the perfect vehicle for your trip today.') }}</p>
            <a href="{{ route('vehicles') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-800 font-bold rounded-xl hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                {{ __('Browse Vehicles') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>
</x-public-layout>
