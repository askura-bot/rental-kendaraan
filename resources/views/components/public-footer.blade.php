<!-- DriveEase-Style Footer -->
<footer class="bg-primary-900 text-gray-300">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Company Info -->
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">{{ config('app.name', 'DriveEase') }}</span>
                </a>
                <p class="text-sm leading-relaxed text-gray-400 mb-6">
                    {{ __('Trusted car rental service with top-rated reviews. We provide quality vehicles for your comfortable journey.') }}
                </p>
                @php
                    $footerFacebook = \App\Models\Setting::getValue('contact_facebook', '');
                    $footerTwitter = \App\Models\Setting::getValue('contact_twitter', '');
                    $footerInstagram = \App\Models\Setting::getValue('contact_instagram', '');
                @endphp
                @if($footerFacebook || $footerTwitter || $footerInstagram)
                    <div class="flex gap-3">
                        @if($footerFacebook)
                            <a href="{{ $footerFacebook }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-primary-800 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if($footerTwitter)
                            <a href="{{ $footerTwitter }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-primary-800 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        @endif
                        @if($footerInstagram)
                            <a href="{{ $footerInstagram }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-primary-800 hover:bg-primary-700 rounded-lg flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">{{ __('Quick Links') }}</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('vehicles') }}" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('Vehicles') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('Contact') }}</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">{{ __('Support') }}</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('FAQ') }}</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('Terms & Conditions') }}</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">{{ __('Rental Policy') }}</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">{{ __('Contact Us') }}</h4>
                @php
                    $footerAddress = \App\Models\Setting::getValue('contact_office_address', 'Jl. Raya Utama No. 123, Jakarta, Indonesia');
                    $footerWhatsapp = \App\Models\Setting::getValue('contact_whatsapp', '+62 812 3456 7890');
                    $footerEmail = \App\Models\Setting::getValue('contact_email', 'info@driveease.com');
                @endphp
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm text-gray-400">{!! nl2br(e($footerAddress)) !!}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span class="text-sm text-gray-400">{{ $footerWhatsapp }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span class="text-sm text-gray-400">{{ $footerEmail }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-primary-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-500">&copy; {{ date('Y') }} {{ config('app.name', 'DriveEase') }}. {{ __('All rights reserved.') }}</p>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-gray-500">{{ __('Designed by') }} DriveEase</span>
                    <span class="text-xs text-gray-500">{{ __('We Accept:') }}</span>
                    <div class="flex gap-1.5">
                        <div class="w-8 h-5 bg-primary-800 rounded flex items-center justify-center text-[8px] text-gray-400 font-bold">VISA</div>
                        <div class="w-8 h-5 bg-primary-800 rounded flex items-center justify-center text-[8px] text-gray-400 font-bold">MC</div>
                        <div class="w-8 h-5 bg-primary-800 rounded flex items-center justify-center text-[8px] text-gray-400 font-bold">BCA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
