<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 dark:text-white">
            {{ __('Contact Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            @if ($message = session('success'))
                <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 dark:bg-gray-800 dark:text-green-400">
                    {{ $message }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <form method="POST" action="{{ route('admin.settings.contact.update') }}" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Office Address --}}
                    <div>
                        <label for="contact_office_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Office Address') }}
                        </label>
                        <textarea
                            id="contact_office_address"
                            name="contact_office_address"
                            rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                        >{{ old('contact_office_address', $settings['contact_office_address']) }}</textarea>
                        @error('contact_office_address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- WhatsApp Number --}}
                    <div>
                        <label for="contact_whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('WhatsApp Number') }}
                        </label>
                        <input
                            type="text"
                            id="contact_whatsapp"
                            name="contact_whatsapp"
                            value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                        />
                        @error('contact_whatsapp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Email Address') }}
                        </label>
                        <input
                            type="email"
                            id="contact_email"
                            name="contact_email"
                            value="{{ old('contact_email', $settings['contact_email']) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                        />
                        @error('contact_email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Working Hours (Weekday) --}}
                    <div>
                        <label for="contact_hours_weekday" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Working Hours (Weekday)') }}
                        </label>
                        <input
                            type="text"
                            id="contact_hours_weekday"
                            name="contact_hours_weekday"
                            value="{{ old('contact_hours_weekday', $settings['contact_hours_weekday']) }}"
                            placeholder="Monday - Saturday: 08:00 - 20:00"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                        />
                        @error('contact_hours_weekday') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Working Hours (Weekend) --}}
                    <div>
                        <label for="contact_hours_weekend" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Working Hours (Weekend)') }}
                        </label>
                        <input
                            type="text"
                            id="contact_hours_weekend"
                            name="contact_hours_weekend"
                            value="{{ old('contact_hours_weekend', $settings['contact_hours_weekend']) }}"
                            placeholder="Sunday: 09:00 - 17:00"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                        />
                        @error('contact_hours_weekend') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Pre-Booking Information --}}
                    <div>
                        <label for="pre_booking_information" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            {{ __('Pre-Booking Information') }}
                        </label>
                        <textarea
                            id="pre_booking_information"
                            name="pre_booking_information"
                            rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                        >{{ old('pre_booking_information', $settings['pre_booking_information']) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Information displayed to users before they book a vehicle.') }}</p>
                        @error('pre_booking_information') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Social Media Accounts --}}
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Social Media') }}</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="contact_facebook" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Facebook URL') }}
                                </label>
                                <input
                                    type="text"
                                    id="contact_facebook"
                                    name="contact_facebook"
                                    value="{{ old('contact_facebook', $settings['contact_facebook']) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                                />
                                @error('contact_facebook') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="contact_twitter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Twitter/X URL') }}
                                </label>
                                <input
                                    type="text"
                                    id="contact_twitter"
                                    name="contact_twitter"
                                    value="{{ old('contact_twitter', $settings['contact_twitter']) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                                />
                                @error('contact_twitter') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="contact_instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Instagram URL') }}
                                </label>
                                <input
                                    type="text"
                                    id="contact_instagram"
                                    name="contact_instagram"
                                    value="{{ old('contact_instagram', $settings['contact_instagram']) }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"
                                />
                                @error('contact_instagram') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-gray-800"
                        >
                            {{ __('Save Settings') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
