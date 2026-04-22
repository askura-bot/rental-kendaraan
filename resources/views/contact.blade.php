<x-public-layout>
    {{-- Page Header --}}
    <section class="bg-primary-900 py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-4">{{ __('Contact Us') }}</h1>
            <p class="text-primary-200 text-base sm:text-lg max-w-2xl mx-auto">{{ __('Have questions or need assistance? We\'d love to hear from you. Get in touch with our team.') }}</p>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="py-12 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-16">

                <!-- Contact Info Cards -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-primary-100 rounded-2xl p-5 sm:p-7 border border-primary-200 shadow-sm">
                        <div class="w-12 h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Our Office') }}</h3>
                        <p class="text-sm text-gray-600">Jl. Raya Utama No. 123,<br>Jakarta, Indonesia 10110</p>
                    </div>

                    <div class="bg-primary-100 rounded-2xl p-5 sm:p-7 border border-primary-200 shadow-sm">
                        <div class="w-12 h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Phone') }}</h3>
                        <p class="text-sm text-gray-600">+62 812 3456 7890</p>
                        <p class="text-sm text-gray-600">+62 21 1234 5678</p>
                    </div>

                    <div class="bg-primary-100 rounded-2xl p-5 sm:p-7 border border-primary-200 shadow-sm">
                        <div class="w-12 h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Email') }}</h3>
                        <p class="text-sm text-gray-600">info@driveease.com</p>
                        <p class="text-sm text-gray-600">support@driveease.com</p>
                    </div>

                    <div class="bg-primary-100 rounded-2xl p-5 sm:p-7 border border-primary-200 shadow-sm">
                        <div class="w-12 h-12 bg-primary-700 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Working Hours') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('Monday - Saturday') }}: 08:00 - 20:00</p>
                        <p class="text-sm text-gray-600">{{ __('Sunday') }}: 09:00 - 17:00</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-3">
                    <div class="bg-gray-50 rounded-2xl p-5 sm:p-8 border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ __('Send us a message') }}</h2>
                        <p class="text-sm text-gray-500 mb-8">{{ __('Fill out the form below and we\'ll get back to you as soon as possible.') }}</p>

                        @if (session('success'))
                            <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('first_name') border-red-400 @enderror" placeholder="{{ __('John') }}">
                                    @error('first_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('last_name') border-red-400 @enderror" placeholder="{{ __('Doe') }}">
                                    @error('last_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Email') }}</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-400 @enderror" placeholder="john@example.com">
                                @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Phone Number') }}</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition" placeholder="+62 812 xxxx xxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Subject') }}</label>
                                <select name="subject" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('subject') border-red-400 @enderror">
                                    <option value="">{{ __('Select a subject') }}</option>
                                    <option value="General Inquiry" @selected(old('subject') === 'General Inquiry')>{{ __('General Inquiry') }}</option>
                                    <option value="Booking Question" @selected(old('subject') === 'Booking Question')>{{ __('Booking Question') }}</option>
                                    <option value="Vehicle Information" @selected(old('subject') === 'Vehicle Information')>{{ __('Vehicle Information') }}</option>
                                    <option value="Partnership" @selected(old('subject') === 'Partnership')>{{ __('Partnership') }}</option>
                                    <option value="Other" @selected(old('subject') === 'Other')>{{ __('Other') }}</option>
                                </select>
                                @error('subject') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ __('Message') }}</label>
                                <textarea name="message" rows="5" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition resize-none @error('message') border-red-400 @enderror" placeholder="{{ __('Write your message here...') }}">{{ old('message') }}</textarea>
                                @error('message') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="w-full px-8 py-3.5 bg-primary-700 text-white font-bold rounded-xl hover:bg-primary-800 transition-colors duration-200 shadow-lg shadow-primary-700/20">
                                {{ __('Send Message') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
