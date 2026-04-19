<!-- DriveEase-Style User Navigation -->
<nav x-data="{ open: false }" class="bg-white sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-18 py-3">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <div class="w-9 h-9 bg-primary-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-primary-800">{{ config('app.name', 'DriveEase') }}</span>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('vehicles') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('vehicles') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">
                    {{ __('Vehicles') }}
                </a>
                <a href="{{ route('about') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('about') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">
                    {{ __('About') }}
                </a>
                <a href="{{ route('contact') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">
                    {{ __('Contact') }}
                </a>
            </div>


            <!-- Mobile Hamburger -->
            <button @click="open = !open"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-primary-700 hover:bg-gray-100 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="md:hidden border-t border-gray-100" @click.away="open = false">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('home') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">{{ __('Home') }}</a>
            <a href="{{ route('vehicles') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('vehicles') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">{{ __('Vehicles') }}</a>
            <a href="{{ route('about') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('about') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">{{ __('About') }}</a>
            <a href="{{ route('contact') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('contact') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-primary-700 hover:bg-gray-50' }}">{{ __('Contact') }}</a>
        </div>

    </div>
</nav>
